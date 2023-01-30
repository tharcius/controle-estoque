<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductRepositoryInterface
{
    public function __construct(protected Product $product)
    {
    }

    public function getAllProducts()
    {
        return $this->product->all();
    }

    public function getProductById(int $id)
    {
        try {
            return $this->product->findOrFail($id);
        } catch (\Exception $exception) {
            return ['error' => "Couldn't find this register"];
        }
    }

    public function deleteProduct(int $id)
    {
        try {
            $product = $this->product->findOrFail($id);
            $product->delete();
            return $product;
        } catch (\Exception $exception) {
            return ['error' => "Failure during deleting"];
        }
    }

    public function createProduct(array $product)
    {
        try {
            $product = $this->product->create($product);
            return $product->stock()->create(['quantity' => 0]);
        } catch (\Exception $exception) {
            return ['error' => "Couldn't save the register"];
        }
    }

    public function updateProduct($id, array $data)
    {
        try {
            $product = $this->product->findOrFail($id);
            $product->update($data);
            return $product;
        } catch (\Exception $exception) {
            return ['error' => "Couldn't update the register"];
        }
    }

    public function flowProduct(int $id, array $data, string $type = 'output')
    {
        try {
            DB::beginTransaction();

            $product = $this->product->with(['stock'])->findOrFail($id);

            if ($type == 'output' && $product->stock->quantity > $data['quantity']) {
                $product->stock->update(['quantity' => $product->stock->quantity - $data['quantity']]);
            } else {
                $product->stock->update(['quantity' => $product->stock->quantity + $data['quantity']]);
            }

            $product->update($data);
            $product->historics()->create($data);
            $result = $this->product->with('historic')->find($id);

            DB::commit();

            return $result;
        } catch (\Exception $exception) {
            DB::rollBack();
            return ['error' => "Couldn't register the {$type}"];
        }
    }
}
