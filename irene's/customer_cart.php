<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodEdge - Order Food</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold my-4">FoodEdge - Order Food</h1>
        <div class="flex">
            <div class="w-2/4 mr-4">
                <h2 class="text-2xl font-bold mb-2 ml-8">Menu</h2>
                <!-- Display food items here with Add to Cart button -->
                <!-- Example: -->
                <form action="cart.php" method="post" class="ml-8 mr-12">
                    <div class="flex justify-between items-center mb-2">
                        <span>Food Item 1</span>
                        <input type="hidden" name="food_id" value="1">
                        <input type="number" name="quantity" class="w-10" value="1">
                        <button type="submit" name="add_to_cart" class="bg-blue-500 text-white px-4 py-2 rounded">Add to Cart</button>
                    </div>

                    <div class="flex justify-between items-center mb-2">
                        <span>Food Item 2</span>
                        <input type="hidden" name="food_id" value="1">
                        <input type="number" name="quantity" class="w-10" value="1">
                        <button type="submit" name="add_to_cart" class="bg-blue-500 text-white px-4 py-2 rounded">Add to Cart</button>
                    </div>

                    <div class="flex justify-between items-center mb-2">
                        <span>Food Item 3</span>
                        <input type="hidden" name="food_id" value="1">
                        <input type="number" name="quantity" class="w-10" value="1">
                        <button type="submit" name="add_to_cart" class="bg-blue-500 text-white px-4 py-2 rounded">Add to Cart</button>
                    </div>

                    <div class="flex justify-between items-center mb-2">
                        <span>Food Item 4</span>
                        <input type="hidden" name="food_id" value="1">
                        <input type="number" name="quantity" class="w-10" value="1">
                        <button type="submit" name="add_to_cart" class="bg-blue-500 text-white px-4 py-2 rounded">Add to Cart</button>
                    </div>
                </form>
                <!-- Repeat for other food items -->
            </div>
            <div class="w-1/3">
                <h2 class="text-2xl font-bold mb-2">Cart</h2>
                <!-- Display items in cart here with options to edit quantity or remove -->
                <!-- Example: -->
                <form action="cart.php" method="post">
                    <div class="flex justify-between items-center mb-2">
                        <span>Food Item 1</span>
                        <input type="hidden" name="food_id" value="1">
                        <input type="number" name="quantity" class="w-10" value="1">
                        <button type="submit" name="update_cart" class="bg-yellow-500 text-white px-2 py-1 ml-2 rounded mr-2">Update</button>
                        <button type="submit" name="remove_from_cart" class="bg-red-500 text-white px-2 py-1 rounded">Remove</button>
                    </div>

                    <div class="flex justify-between items-center mb-2">
                        <span>Food Item 2</span>
                        <input type="hidden" name="food_id" value="1">
                        <input type="number" name="quantity" class="w-10" value="1">
                        <button type="submit" name="update_cart" class="bg-yellow-500 text-white px-2 py-1 ml-2 rounded mr-2">Update</button>
                        <button type="submit" name="remove_from_cart" class="bg-red-500 text-white px-2 py-1 rounded">Remove</button>
                    </div>

                    <div class="flex justify-between items-center mb-2">
                        <span>Food Item 3</span>
                        <input type="hidden" name="food_id" value="1">
                        <input type="number" name="quantity" class="w-10" value="1">
                        <button type="submit" name="update_cart" class="bg-yellow-500 text-white px-2 py-1 ml-2 rounded mr-2">Update</button>
                        <button type="submit" name="remove_from_cart" class="bg-red-500 text-white px-2 py-1 rounded">Remove</button>
                    </div>

                    <div class="flex justify-between items-center mb-2">
                        <span>Food Item 4</span>
                        <input type="hidden" name="food_id" value="1">
                        <input type="number" name="quantity" class="w-10" value="1">
                        <button type="submit" name="update_cart" class="bg-yellow-500 text-white px-2 py-1 ml-2 rounded mr-2">Update</button>
                        <button type="submit" name="remove_from_cart" class="bg-red-500 text-white px-2 py-1 rounded">Remove</button>
                    </div>
                </form>
                <!-- Repeat for other items in cart -->
                <div class="mt-4">
                    <button class="bg-green-500 text-white px-4 py-2 rounded">Checkout</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>