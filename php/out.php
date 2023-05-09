<?php
// Load the cart from the file
$cart = [];
if (file_exists('cart.txt')) {
  $cart_lines = file('cart.txt', FILE_IGNORE_NEW_LINES);
  foreach ($cart_lines as $cart_line) {
    $cart_parts = explode(',', $cart_line);
    $cart_product = [
      'name' => $cart_parts[0],
      'price' => $cart_parts[1],
      'quantity' => $cart_parts[2],
    ];
    $cart[$cart_parts[0]] = $cart_product;
  }
}

// Clear the cart
$filess=fopen('cart.txt',"w");
// Display the checkout confirmation
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Checkout Confirmation</title>
</head>
<body>
  <h1>Checkout Confirmation</h1>
  <p>Thank you for your purchase!</p>
  <table>
    <tr>
      <th>Product Name</th>
      <th>Price</th>
      <th>Quantity</th>
      <th>Total</th>
    </tr>
    <?php
    // Display the cart contents
    $total = 0;
    foreach ($cart as $cart_product) {
      $product_total = $cart_product['price'] * $cart_product['quantity'];
      $total += $product_total;
      ?>
      <tr>
        <td><?php echo $cart_product['name']; ?></td>
        <td>$<?php echo number_format($cart_product['price'], 2); ?></td>
        <td><?php echo $cart_product['quantity']; ?></td>
        <td>$<?php echo number_format($product_total, 2); ?></td>
      </tr>
      <?php
    }
    ?>
    <tr>
      <td colspan="3" align="right">Total:</td>
      <td>$<?php echo number_format($total, 2); ?></td>
    </tr>
  </table>
</body>
</html>

