<?php

namespace App\Services\Product;

use App\Models\Product;
use App\Repositories\Product\ProductRepository;
use Exception;

class ProductService
{
    private ProductRepository $productRepository;

    public function __construct()
    {
        $this->productRepository = new ProductRepository();
    }

    public function getProducts(): array
    {
        return $this->productRepository->getAll();
    }

    public function getProductById(string $id): Product
    {
        $product = $this->productRepository->findBy('id', $id);

        if (!$product) {
            throw new Exception('Producto no encontrado.', 404);
        }

        return $product;
    }

    public function createProduct(Product $product): Product
    {
        $exists = $this->productRepository->findBy('name', $product->name);

        if ($exists) {
            throw new Exception('Ya existe un producto con ese nombre.', 409);
        }

        $createdId = $this->productRepository->add($product);

        if (!$createdId) {
            throw new Exception('Hubo un error al guardar el producto.', 500);
        }

        return $this->getProductById($createdId);
    }

    public function updateProduct(Product $product): Product
    {
        $updated = $this->productRepository->update($product);

        if (!$updated) {
            throw new Exception('Hubo un error al actualizar el producto.', 500);
        }

        return $this->getProductById($product->id);
    }

    public function changeStatus(string $productId): Product
    {
        $changed = $this->productRepository->changeStatus($productId);

        if (!$changed) {
            throw new Exception('No se pudo cambiar el estado del producto.', 500);
        }

        return $this->getProductById($productId);
    }
}
