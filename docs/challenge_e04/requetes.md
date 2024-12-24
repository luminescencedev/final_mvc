# Requêtes SQL

## Récupérer tous les produits

```sql
SELECT * FROM `product`;
```

## Layout

### Pour afficher la liste des catégories dans le header
```sql
SELECT * FROM `category`;
```

### Pour afficher la liste des types dans le header
```sql
SELECT * FROM `type`;
```

### Pour afficher la liste des marques dans le header
```sql
SELECT * FROM `brand`;
```

## Home

### Pour afficher les 5 catégories mises en avant
```sql
SELECT * FROM `category` WHERE home_order > 0 ORDER BY home_order LIMIT 5;
```

## Catégorie

### Pour afficher tous les produits de la catégorie #1 triés par nom croissant
```sql
SELECT * FROM `product` WHERE category_id = 1 ORDER BY name ASC;
```
### Pour afficher tous les produits de la catégorie #1 triés par prix croissant
```sql
SELECT * FROM `product` WHERE category_id = 1 ORDER BY price ASC;
```

## Type

### Pour afficher tous les produits du type de produit #1 triés par nom croissant
```sql
SELECT * FROM `product` WHERE type_id = 1 ORDER BY name ASC;
```
### Pour afficher tous les produits du type de produit #1 triés par prix croissant
```sql
SELECT * FROM `product` WHERE type_id = 1 ORDER BY price ASC;
```

## Marque

### Pour afficher tous les produits de la marque #2 triés par nom croissant
```sql
SELECT * FROM `product` WHERE brand_id = 2 ORDER BY name ASC;
```
### Pour afficher tous les produits de la marque #2 triés par prix croissant
```sql
SELECT * FROM `product` WHERE brand_id = 2 ORDER BY price ASC;
```

## Produit détail

### Pour afficher tous la page détail d'un produit + sa marque et son type

```sql
SELECT product.*, brand.name AS brand_name , category.name AS category_name
FROM product
LEFT JOIN brand ON brand.id = product.brand_id
LEFT JOIN category ON category.id = product.category_id
WHERE product.id = 2;
```