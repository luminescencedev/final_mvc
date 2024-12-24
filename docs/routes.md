# Routes

## Sprint 1
| URL | HTTP Method | Controller | Method | Title | Content | Comment |
|--|--|--|--|--|--|--|
| `/` | `GET` | `MainController` | `home` | Dans les shoe | 5 categories | - |
| `/mentions-legales/` | `GET` | `MainController` | `legalMentions` | Legal Mentions | Legal Mentions | - |
| `/catalogue/category/[id]` | `GET` | `CatalogController` | `category` | Name of the category | Products list of the current category |[id] represents the id of the current category |
| `/catalogue/type/[id]` | `GET` | `CatalogController` | `type` | Name of the type | Products list of the current type |[id] represents the id of the current type |
| `/catalogue/marque/[id]` | `GET` | `CatalogController` | `brand` | Name of the brand | Products list of the current brand |[id] represents the id of the current brand |
| `/catalogue/produit/[id]` | `GET` | `CatalogController` | `product` | Name of the product | Product detail|[id] represents the id of the current product |
