<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\About;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\District;
use App\Models\Province;
use App\Models\UserView;
use App\Events\InquiryEvent;
use App\Models\RatingReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{

    // ----------------------Contact API-------------------
    
   public function indexInquiry(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'email|required',
                'message' => 'required',
                'user_id' => 'nullable',
            ]);


            if ($validation->fails()) {
                return response()->json(['statusCode' => 401, 'error' => true, 'error_message' => $validation->errors(), 'message' => 'Please fill the input field properly']);
            }
            Contact::create($request->all());

        Broadcast(new InquiryEvent($request->all()));

           
            return response()->json([
                "statusCode" => 200,
                "error" => false,
                'message' => 'Thank you, your enquiry has been submitted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['statusCode' => 401, 'error' => true, 'message' => $e->getMessage()]);
        }
    }


// -----------------------------Category API---------------------------
public function categoryIndex()
{
    try {
        $categories = Category::with('product')->get();

        // Iterate through categories and update the image path for each product
        foreach ($categories as $category) {
            foreach ($category->product as $product) {
                $product['image'] = asset('storage/' . $product->image);
            }
        }

        return response()->json([
            "statusCode" => 200,
            "error" => false,
            'data' => $categories
        ]);
    } catch (\Exception $e) {
        return response()->json(['statusCode' => 401, 'error' => true, 'message' => $e->getMessage()]);
    }
}


// -------------------------SINGLE CATEGORY API---------------------------
public function categorysingle($id)
{
    try {
        $category = Category::with('product')->findOrFail($id);

        // Update the image path for each product in this category
        foreach ($category->product as $product) {
            $product['image'] = asset('storage/' . $product->image);
        }

        return response()->json([
            "statusCode" => 200,
            "error" => false,
            'data' => $category
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'statusCode' => 404, 
            'error' => true, 
            'message' => 'Category not found'
        ]);
    }
}



// --------------------------------About API--------------------------
public function aboutIndex()
    {
        try {
            
           $abouts=About::get();
           foreach ($abouts as $key => $about) {
            $about['image']=asset('storage/' . $about->image);
           }
            return response()->json([
                "statusCode" => 200,
                "error" => false,
                'date' => $abouts
            ]);
        } catch (\Exception $e) {
            return response()->json(['statusCode' => 401, 'error' => true, 'message' => $e->getMessage()]);
        }
    }
// ---------------------------POST Cart API------------------------------
public function cart(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), [
                'user_id' => 'required',
                'product_id' => 'required',
                'quantity' => 'required'
            ]);
           

            if ($validation->fails()) {
                return response()->json(['statusCode' => 401, 'error' => true, 'error_message' => $validation->errors(), 'message' => 'Please fill the input field properly']);
            }
            Cart::create($request->all());
           
            return response()->json([
                "statusCode" => 200,
                "error" => false,
                'message' => 'Thank you, your enquiry has been submitted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['statusCode' => 401, 'error' => true, 'message' => $e->getMessage()]);
        }
    }
// --------------------------Get Cart API----------------------------
    public function getCart()
    {
        try {
            
           $carts=Cart::with('product','user')->get();
            return response()->json([
                "statusCode" => 200,
                "error" => false,
                'date' => $carts
            ]);
        } catch (\Exception $e) {
            return response()->json(['statusCode' => 401, 'error' => true, 'message' => $e->getMessage()]);
        }
    }




    //------------------------ Get login User Cart--------------------
    public function singleUserCart($id)
{
    try {
        // Fetch cart items with related product and user details for the authenticated user
        $cartItems = Cart::with('product', 'user')->where('user_id', $id)->get();
        

        // Loop through the cart items to modify the product's image path
        foreach ($cartItems as $cart) {
            if ($cart->product) {
                $cart->product->image = asset('storage/' . $cart->product->image);
            }
        }

        // Check if the cart is empty
        if ($cartItems->isEmpty()) {
            return response()->json([
                'statusCode' => 404,
                'error' => true,
                'message' => 'No items found in your cart',
                'data' => []
            ], 404);
        }
        // Return the cart items as JSON
        return response()->json([
            'statusCode' => 200,
            'error' => false,
            'message' => 'Cart items retrieved successfully',
            'data' => $cartItems
        ], 200);

    } catch (\Exception $e) {
        // Handle errors
        return response()->json([
            'statusCode' => 500,
            'error' => true,
            'message' => 'An error occurred: ' . $e->getMessage()
        ], 500);
    }
}


// --------------------------UPDATE Cart-------------------------

public function updateCartItem(Request $request, $id)
{
    try {
        // Validate the input
        $validation = Validator::make($request->all(), [
            'quantity' => 'required|integer|min:1'
        ]);

        if ($validation->fails()) {
            return response()->json([
                'statusCode' => 400,
                'error' => true,
                'message' => $validation->errors()
            ]);
        }

        // Find the cart item by ID
        $cartItem = Cart::find($id);

        // Check if the cart item exists
        if (!$cartItem) {
            return response()->json([
                'statusCode' => 404,
                'error' => true,
                'message' => 'Cart item not found'
            ], 404);
        }

        // Update the cart item quantity
        $cartItem->update($request->all());
        

        return response()->json([
            'statusCode' => 200,
            'error' => false,
            'message' => 'Cart item updated successfully'
        ], 200);

    } catch (\Exception $e) {
        return response()->json([
            'statusCode' => 500,
            'error' => true,
            'message' => 'An error occurred: ' . $e->getMessage()
        ], 500);
    }
}

// -----------------------------DELETE Cart-------------------------------


public function deleteCartItem($id)
{
    try {
        // Find the cart item by ID
        $cartItem = Cart::find($id);

        // Check if the cart item exists
        if (!$cartItem) {
            return response()->json([
                'statusCode' => 404,
                'error' => true,
                'message' => 'Cart item not found'
            ], 404);
        }

        // Delete the cart item
        $cartItem->delete();

        return response()->json([
            'statusCode' => 200,
            'error' => false,
            'message' => 'Cart item deleted successfully'
        ], 200);

    } catch (\Exception $e) {
        return response()->json([
            'statusCode' => 500,
            'error' => true,
            'message' => 'An error occurred: ' . $e->getMessage()
        ], 500);
    }
}


// ----------------------POST Order API------------------------

public function order(Request $request)
{
    try {
        // Validate all necessary inputs
        $validation = Validator::make($request->all(), [
            'user_id'       => 'required|exists:users,id',  // Must exist in the users table
            'name'          => 'required|string|max:255',   // Required name field, max 255 characters
            'phoneno'       => 'required|digits:10',        // Must be a 10-digit phone number
            'province'      => 'required|string|max:255',   // Required province field, max 255 characters
            'district'      => 'required|string|max:255',   // Required district field, max 255 characters
            'city'          => 'required|string|max:255',   // Required city field, max 255 characters
            'postalcode'    => 'required|string|max:10',    // Postal code required, max length of 10
            'streetaddress' => 'required|string|max:255',   // Required street address, max 255 characters
        ]);

        if ($validation->fails()) {
            return response()->json([
                'statusCode'    => 401,
                'error'         => true,
                'error_message' => $validation->errors(),
                'message'       => 'Please fill in all required fields correctly.'
            ]);
        }

        // Fetch the cart items for the user
        $cartItems = Cart::where('user_id', $request->user_id)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return response()->json([
                'statusCode' => 400,
                'error'      => true,
                'message'    => 'Your cart is empty. Please add items to your cart before placing an order.'
            ]);
        }

        // Calculate the total price
        $total = $cartItems->sum(function ($cartItem) {
            return $cartItem->product->price * $cartItem->quantity;
        });

        // Create the order
        $order = Order::create([
            'user_id'       => $request->user_id,
            'name'          => $request->input('name'),            // Full name
            'phoneno'       => $request->input('phoneno'),         // Phone number
            'province'      => $request->input('province'),        // Province
            'district'      => $request->input('district'),        // District
            'city'          => $request->input('city'),            // City
            'postalcode'    => $request->input('postalcode'),      // Postal code
            'streetaddress' => $request->input('streetaddress'),   // Street address
            'total'         => $total,
            'status'        => 'pending',                          // Default status
            'invoice'       => $request->input('invoice'),                             // Unique invoice number (timestamp)
        ]);

        // Attach products to the order and clear the cart
        foreach ($cartItems as $cartItem) {
            $order->orderItems()->create([
                'product_id' => $cartItem->product_id,
                'quantity'   => $cartItem->quantity,
                'price'      => $cartItem->product->price,
            ]);
        }

        // Clear the cart for this user
        Cart::where('user_id', $request->user_id)->delete();

        return response()->json([
            "statusCode" => 200,
            "error"      => false,
            'message'    => 'Order placed successfully.',
            'order'      => $order
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'statusCode' => 500,
            'error'      => true,
            'message'    => 'An error occurred while placing the order: ' . $e->getMessage()
        ]);
    }
}




// Update order status arrcoding to payment success or failed
public function updateOrderStatus(Request $request, $transactionCode)
{
    try {
        // Retrieve the order based on the transaction_code from the URL
        $order = Order::where('invoice', $transactionCode)->first();

        // Check if the order exists
        if (!$order) {
            return response()->json([
                'statusCode' => 404,
                'error'      => true,
                'message'    => 'Order not found.',
            ]);
        }

        // Validate the incoming request
        $request->validate([
            'status' => 'required|string', // Adjust the status values as needed
        ]);

        // Update the status field
        $order->update(['status' => $request->status]);

        return response()->json([
            'statusCode' => 200,
            'error'      => false,
            'message'    => 'Order status updated successfully.',
            'order'      => $order,
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'statusCode' => 500,
            'error'      => true,
            'message'    => 'An error occurred while updating the order status: ' . $e->getMessage(),
        ]);
    }
}















    // ------------------------------GET Single users Order API---------------------
   public function getOrder($userId)
{
    try {
        // Retrieve orders for the specified user
     $orders= Order::with(['user', 'orderItems.product'])
               ->where('user_id', $userId)
               ->get();
    if($orders->isEmpty()){
        $orders= Order::with(['user', 'orderItems.product'])
               ->where('invoice', $userId)
               ->get();
    }


        // Check if the user has orders
        if ($orders->isEmpty()) {
            return response()->json([
                "statusCode" => 404,
                "error" => true,
                "message" => "No orders found for this user."
            ]);
        }

        return response()->json([
            "statusCode" => 200,
            "error" => false,
            "data" => $orders
        ]);
    } catch (\Exception $e) {
        return response()->json(['statusCode' => 401, 'error' => true, 'message' => $e->getMessage()]);
    }
}


 public function getAllOrder()
{
    try {
        // Retrieve orders for the specified user
        $orders = Order::with('user','orderItems.product')->get();
        
        // Check if the user has orders
        if ($orders->isEmpty()) {
            return response()->json([
                "statusCode" => 404,
                "error" => true,
                "message" => "No orders found for this user."
            ]);
        }

        return response()->json([
            "statusCode" => 200,
            "error" => false,
            "data" => $orders
        ]);
    } catch (\Exception $e) {
        return response()->json(['statusCode' => 401, 'error' => true, 'message' => $e->getMessage()]);
    }
}



    // ----------------getProduct  API----------------------


    public function productsIndex()
    {
 $today = Carbon::today();
 try {
     $products = Product::with('category')->get();
     foreach ($products as $key => $product) {
                $product['image']=asset('storage/' . $product->image);
            }
            
             foreach ($products as $key => $product) {
            if($product['discount']===0 || $product['discount']==='null'){
                unset($product['discount']);
                unset($product['discount_start_date']);
                unset($product['discount_end_date']);
            }
        if ($today < $product->discount_start_date){
            $product['youwillget']=$product['discount'];
            $product['discount']=0;
            // $product['discount_start_date']='';
            // $product['discount_end_date']='';

        }

            }
            return response()->json([
                "statusCode" => 200,
                "error" => false,
                'data' => $products
            ]);
        } catch (\Exception $e) {
            return response()->json(['statusCode' => 401, 'error' => true, 'message' => $e->getMessage()]);
        }
    }


    // Fetch single and related product

   public function productSingle($id, Request $request)
    {
        try {
            // Get userId from query parameter
            $authUser = $request->query('userId'); 

            // Define today's date
            $today = Carbon::today();

            // Fetch the product along with its category
            $product = Product::with('category')->findOrFail($id);
            $product['image'] = asset('storage/' . $product->image);

            // Check if the product has a discount
            if ($product['discount'] === 0 || $product['discount'] === 'null') {
                unset($product['discount']);
                unset($product['discount_start_date']);
                unset($product['discount_end_date']);
            }

            // Check if the discount is active
            if ($today < $product->discount_start_date || $today > $product->discount_end_date) {
                $product['youwillget'] = $product['discount'];
                $product['discount'] = 0; // Set discount to 0 if not active
            }

            if ($authUser && $authUser !=0) {
                // If the user is logged in, check if they have already viewed the product
                $userView = UserView::where('user_id', $authUser)
                                    ->where('product_id', $id)
                                    ->first();

                if (!$userView) {
                    // Increment the views count if the user hasn't viewed the product yet
                    $product->increment('views');

                    // Store the user's view in the user_views table
                    UserView::create([
                        'user_id' => $authUser,
                        'product_id' => $id,
                    ]);
                }
            } else {
                // If the user is not logged in, increment the view count as a guest
                $product->increment('views');
            }

            // Fetch related products from the same category, excluding the current product
            $relatedProducts = Product::with('category')
                ->where('category_id', $product->category_id)
                ->where('id', '!=', $id) // Exclude the current product
                ->get();

            foreach ($relatedProducts as $relatedProduct) {
                $relatedProduct['image'] = asset('storage/' . $relatedProduct->image);
            }

            return response()->json([
                "statusCode" => 200,
                "error" => false,
                'data' => [
                    'product' => $product,
                    'related_products' => $relatedProducts
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Error fetching product: ' . $e->getMessage());
            return response()->json(['statusCode' => 404, 'error' => true, 'message' => 'Product not found']);
        }
    }



// API for Address i.e province & districts

public function getProvinces()
    {
        try {
            $provinces = Province::get();
            return response()->json([
                "statusCode" => 200,
                "error" => false,
                "data" => $provinces
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "statusCode" => 401,
                "error" => true,
                "message" => $e->getMessage()
            ]);
        }
    }

    // Get all districts
    public function getDistricts()
    {
        try {
            $districts = District::with('province')->get();
            return response()->json([
                "statusCode" => 200,
                "error" => false,
                "data" => $districts
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "statusCode" => 401,
                "error" => true,
                "message" => $e->getMessage()
            ]);
        }
    }

    // Get districts by a specific province
    public function getDistrictsByProvince($provinceName)
    {
        try {
            $province = Province::where('name', $provinceName)->first();

            if (!$province) {
                return response()->json([
                    "statusCode" => 404,
                    "error" => true,
                    "message" => "Province not found"
                ]);
            }

            $districts = District::where('province_id', $province->id)->get();
            return response()->json([
                "statusCode" => 200,
                "error" => false,
                "data" => $districts
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "statusCode" => 401,
                "error" => true,
                "message" => $e->getMessage()
            ]);
        }
    }

// Fetch all reating and review
 public function ratingReview()
{
    try {
        // Retrieve all rating reviews with associated product and user data
        $ratingReviews = RatingReview::with('product', 'user')->get();

        if ($ratingReviews->isEmpty()) {
            return response()->json([
                "statusCode" => 404,
                "error" => true,
                "message" => "RatingReview not found"
            ]);
        }

        return response()->json([
            "statusCode" => 200,
            "error" => false,
            "data" => $ratingReviews
        ]);
    } catch (\Exception $e) {
        return response()->json([
            "statusCode" => 500, // Use 500 for server errors
            "error" => true,
            "message" => "An error occurred: " . $e->getMessage()
        ]);
    }
}


// Fetch single products reating and review
 public function singleproductratingReview($id)
{
    try {
        // Retrieve all rating reviews with associated product and user data
        $ratingReviews = RatingReview::with('product', 'user')->where('product_id',$id)->get();

        if ($ratingReviews->isEmpty()) {
            return response()->json([
                "statusCode" => 404,
                "error" => true,
                "message" => "RatingReview not found"
            ]);
        }

        return response()->json([
            "statusCode" => 200,
            "error" => false,
            "data" => $ratingReviews
        ]);
    } catch (\Exception $e) {
        return response()->json([
            "statusCode" => 500, // Use 500 for server errors
            "error" => true,
            "message" => "An error occurred: " . $e->getMessage()
        ]);
    }
}


// post rating and review
public function storeRatingReview(Request $request)
{
    // Validate incoming request data
    $request->validate([
        'product_id' => 'required|exists:products,id', // Ensure product exists
        'user_id' => 'required|exists:users,id', // Ensure user exists
        'rating' => 'required|integer|between:1,5', // Rating should be between 1 and 5
        'review' => 'required|string|max:500', // review should not exceed 500 characters
    ]);

    try {
        // Create a new rating review
        $ratingReview = RatingReview::create($request->all());

        return response()->json([
            "statusCode" => 201,
            "error" => false,
            "message" => "RatingReview created successfully",
            "data" => $ratingReview
        ]);
    } catch (\Exception $e) {
        return response()->json([
            "statusCode" => 500, // Use 500 for server errors
            "error" => true,
            "message" => "An error occurred: " . $e->getMessage()
        ]);
    }
}



// Show Recommandation API
    public function getRecommendations($userId)
    {
        try {
            // If user ID is 0 (guest user), recommend products based on highest views
            if ($userId == 0) {
                $recommendedProducts = $this->getMostViewedProducts();
                return $this->respondWithSuccess($recommendedProducts);
            }

            // Step 1: Fetch the most recent order for this user
            $recentOrder = $this->getRecentOrder($userId);

            // Handle case where no recent orders exist
            if (!$recentOrder) {
                // Fallback to recommending the most viewed products across all categories
                $recommendedProducts = $this->getMostViewedProducts();
                return $this->respondWithSuccess($recommendedProducts);
            }

            // Step 2: Extract the product's category and ID from the most recent order
            $productCategory = $recentOrder->orderItems->first()->product->category_id;
            $recentProductId = $recentOrder->orderItems->first()->product->id;

            // Step 3: Get recommended products based on the extracted data
            $recommendedProducts = $this->getRecommendedProducts($productCategory, $recentProductId);

            // Step 4: Return the results
            return $this->respondWithSuccess($recommendedProducts);

        } catch (\Exception $e) {
            return $this->respondWithError("An error occurred: " . $e->getMessage());
        }
    }

    /**
     * Fetch the most recent order for a given user.
     *
     * @param int $userId
     * @return \App\Models\Order|null
     */
    private function getRecentOrder(int $userId)
    {
        return Order::with('orderItems.product')
                    ->where('user_id', $userId)
                    ->latest()
                    ->first();
    }

    /**
     * Get recommended products based on category, excluding the recently ordered product.
     *
     * @param int $categoryId
     * @param int $recentProductId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getRecommendedProducts(int $categoryId, int $recentProductId)
    {
        return Product::where('category_id', $categoryId)
                    ->where('id', '!=', $recentProductId)  // Exclude the ordered product
                    ->orderByDesc('views')  // Order by views (popularity)
                    ->limit(5)  // Limit the result to top 5 products
                    ->get()
                    ->map(function ($product) {
                        $product->image = asset('storage/' . $product->image);
                        return $product;
                    });
    }

    /**
     * Get the most viewed products across all categories if no recent activity is found.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getMostViewedProducts()
    {
        return Product::orderByDesc('views')  // Order by views (most popular)
                    ->limit(5)  // Limit the result to top 5 products
                    ->get()
                    ->map(function ($product) {
                        $product->image = asset('storage/' . $product->image);
                        return $product;
                    });
    }

    /**
     * Return a success response with product data.
     *
     * @param \Illuminate\Database\Eloquent\Collection $products
     * @return \Illuminate\Http\JsonResponse
     */
    private function respondWithSuccess($products)
    {
        return response()->json([
            "statusCode" => 200,
            "error" => false,
            "data" => $products
        ]);
    }

    /**
     * Return an error response with a message.
     *
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    private function respondWithError($message)
    {
        return response()->json([
            "statusCode" => 404,
            "error" => true,
            "message" => $message
        ]);
    }

















}