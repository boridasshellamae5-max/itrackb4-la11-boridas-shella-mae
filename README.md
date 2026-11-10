
ITRACKB4 Laboratory Activity 11
Finish Your Own CRUD


G1. Route model binding needs two things to be true. Name both, and say what happens when only one of them is?

Route model binding requires the route parameter name to match the controller's model parameter and the controller to use the correct type-hinted Eloquent model. In my project, `{product}` matches `Product $product` in the controller; if one does not match, Laravel may fail to resolve the expected model or return a 404 error.

G2. Your Delete link opened the detail page instead of deleting anything. Explain why?

An HTML anchor link sends a GET request, not a DELETE request. Since my `products.show` route handles GET requests at `/products/{product}`, clicking the Delete link opened the product details page instead of deleting the record.

G3. old() takes a second argument on your edit form. What would break if you left it out, and what would break if you used only it?

The second argument in `old('name', $product->name)` displays the existing saved product value when the edit form first loads. Without the second argument, the field may appear blank on the first load; using only `old()` also fails to show the saved value when there is no previous submitted input.
