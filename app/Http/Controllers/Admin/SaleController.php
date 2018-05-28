<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleHasProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SaleController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function index(Request $request)
    {
        if (0 == $id = $request->query->getInt('sale')) {
            return $this->resolveSaleReference();
        }

        $sale = Sale::find($id);

        return view('admin.sale.index', compact('sale'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function includeProduct(Request $request)
    {
        /** @var SaleHasProduct $saleHasProduct */
        $response = SaleHasProduct::addProductForSale($request);

        return response()->json($response);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listProductsSale(int $id)
    {
        $queryProducts = SaleHasProduct::query()->get();

        $products = [];
        foreach ($queryProducts as $product) {
            if ($product->value('sale_id') === $id) {
                $products[] = [
                    'id' => $product->id,
                    'name' => Product::find($product->value('product_id'))->name,
                    'price' => Product::find($product->value('product_id'))->price,
                    'quantity' => $product->quantity,
                    'total' => $product->total
                ];
            }
        }

        return response()->json($products);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function selectClient(Request $request)
    {
        $term = trim($request->request->get('q'));

        if (empty($term)) {
            return response()->json([]);
        }

        $clients = Client::search($term)->limit(5)->get();

        $formatted_clients = [];

        foreach ($clients as $client) {
            $formatted_clients[] = ['id' => $client->id, 'text' => $client->name];
        }

        return response()->json($formatted_clients);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function selectProduct(Request $request)
    {
        $term = trim($request->request->get('q'));

        if (empty($term)) {
            return response()->json([]);
        }

        $products = Product::search($term)->limit(5)->get();

        $formatted_products = [];

        foreach ($products as $product) {
            $formatted_products[] = ['id' => $product->id, 'text' => $product->name];
        }

        return response()->json($formatted_products);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    private function resolveSaleReference()
    {
        $sale = Sale::create();

        return redirect()
            ->route('admin.sale', [
                'sale' => $sale->id
            ]);
    }
}
