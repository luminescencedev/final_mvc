<?php

namespace App\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Type;

class MainController extends CoreController
{

    public function test()
    {
        $brandModel = new Brand(); // peut modifier Brand avec les autres nom de model pour tester
        $list = $brandModel->findAll();
        $elem = $brandModel->find(7);
        dump($list);
        dump($elem);
    }
    /**
     * Affiche la page d'accueil du site
     */
    public function home()
    {
        // Ci dessous je créer une instance du model Category
        $categoryModel = new Category();
        // Ensuite j'execute la fonction findAllForHomePage() du model Category
        $categories = $categoryModel->findAllForHomePage();
        // dump($categories);
        $this->show('home', [
            'categories' => $categories
        ]);
    }

    /**
     * Show legal mentions page
     */
    public function legalMentions()
    {
        // Affiche la vue dans le dossier views
        $this->show('mentions');
    }

    /**
     * Show cart page
     */ 
    public function cart()
    {
        $productModel = new Product();
        $products = $productModel->findAll();

        // Convert Product objects to arrays
        $productsArray = array_map(function($product) {
            return [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'description' => $product->getDescription(),
                'picture' => $product->getPicture(),
                'price' => $product->getPrice(),
                'status' => $product->getStatus(),
                'brand_id' => $product->getBrand_id(),
                'category_id' => $product->getCategory_id(),
                'type_id' => $product->getType_id(),
                'rate' => $product->getRate()
            ];
        }, $products);

        $this->show('cart', [
            'products' => $productsArray
        ]);
    }
}