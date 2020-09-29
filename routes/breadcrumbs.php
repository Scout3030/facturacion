<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Inicio', route('home.index'));
});

// Home > Products
Breadcrumbs::for('products', function ($trail) {
    $trail->parent('home');
    $trail->push('Productos', route('products.index'));
});

// Home > Categories
Breadcrumbs::for('categories', function ($trail) {
    $trail->parent('home');
    $trail->push('Categorías', route('categories.index'));
});

// Home > Clients
Breadcrumbs::for('clients', function ($trail) {
    $trail->parent('home');
    $trail->push('Clientes', route('clients.index'));
});

// Home > Users
Breadcrumbs::for('users', function ($trail) {
    $trail->parent('home');
    $trail->push('Usuarios', route('users.index'));
});

// Home > orders
Breadcrumbs::for('orders', function ($trail) {
    $trail->parent('home');
    $trail->push('Ordenes', route('orders.index'));
});

// Home > Category > Create
Breadcrumbs::for('category-create', function ($trail) {
    $trail->parent('categories');
    $trail->push('Crear', route('categories.create'));
});

// Home > Categories > [Category]
Breadcrumbs::for('category', function ($trail, $category) {
    $trail->parent('categories');
    $trail->push($category->name, route('categories.edit', $category->id));
});

// Home > Clients > Create
Breadcrumbs::for('client-create', function ($trail) {
    $trail->parent('clients');
    $trail->push('Crear', route('clients.create'));
});

// Home > Clients > [Client]
Breadcrumbs::for('client', function ($trail, $client) {
    $trail->parent('clients');
    $trail->push($client->name, route('clients.edit', $client->title));
});

// Home > Product > Create
Breadcrumbs::for('product-create', function ($trail) {
    $trail->parent('products');
    $trail->push('Crear', route('products.create'));
});

// Home > Products > [Product]
Breadcrumbs::for('product', function ($trail, $product) {
    $trail->parent('products');
    $trail->push($product->name, route('products.edit', $product->name));
});

// Home > Order > Create
Breadcrumbs::for('order-create', function ($trail) {
    $trail->parent('orders');
    $trail->push('Crear', route('orders.create'));
});

// Home > Order > [Order]
Breadcrumbs::for('order', function ($trail, $order) {
    $trail->parent('orders');
    $trail->push($order->id, route('orders.edit', $order));
});
