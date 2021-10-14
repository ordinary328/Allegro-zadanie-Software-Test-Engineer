# Zadanie rekrutacyjne Software Test Engineer
Aby przeprowadzić test należy mieć otwartą konsolę poleceń w lokalizacji w której zawarte są pliki z kodem php. Gdy jest to już zrobione w konsoli należy wpisać php oraz nazwę pliku z rozszerzeniem (np. php nazwa_pliku.php)

Aby wykonać jakikolwiek test w pierwszej kolejności należy uzyskać token dostępu dla swojego programu. Aby to zrobić należy zdefiniować CLIENT_ID oraz CLIENT_SECRET. Oba te parametry generowane są gdy stworzymy nową aplikację w https://apps.developer.allegro.pl/. 
Dodane są one w 3 i 4 lini każdego pliku php. Dzięki temu funkcja getAccessToken() generuje token używany do autoryzacji. 

## Testy akceptacyjne dla metody:

1. ### __GET IDs of Allegro categories, /sale/categories__
__GET_IDs_of_Allegro_categories.php__


testowany endpoint: https://api.allegro.pl/sale/categories

Test dla odpowiedzi 200 (prawidłowej) powinien zwracać listę głównych kategorii Allegro: Dom i ogród, Dziecko, Elektronika, Firma i usługi, Kolekcje i sztuka, Kultura i rozrywka, Moda, Motoryzacja, Nieruchomości, Sport i turystyka, Uroda, Supermarket, Zdrowie

Zapytanie zwrócone z wynikiem pozytywnym (200) powinno zwrócić tablicę kategorii zawierająch następujące obiekty:
* id
* leaf
* name
* options
    * advertisement
    * advertisementPriceOptional
    * variantsByColorPatternAllowed
    * offersWithProductPublicationEnabled	
    * productCreationEnabled
    * customParametersEnabled
* parent



- - -
- - -
__GET_IDs_of_Allegro_categories_error404.php__

Testowany endpoint: https://api.allegro.pl/sale/categories

Test tego endpointu powinien dać odpowiedź 404 zwracając tablicę z danymi błędu zawierającą poniższe obiekty.
```Json 
{
  "errors": [
    {
      "code": "NotFoundException",
      "message": "Not found",
      "details": null,
      "path": null,
      "userMessage": "Function is not available. Contact the author of the application."
    }
  ]
}

```

2. ### __GET a category by ID, /sale/categories/{categoryId}__
__GET_a_category_by_ID.php__

Testowany endpoint: https://api.allegro.pl/sale/categories/709


Odpowiedź pozytywna (200) powinna zawierać, następujące obiekty:
* id
* leaf
* name
* options
    * advertisement
    * advertisementPriceOptional
    * variantsByColorPatternAllowed
    * offersWithProductPublicationEnabled	
    * productCreationEnabled
    * customParametersEnabled
* parent
    * id

---
---
__GET_a_category_by_ID_error404.php__

testowany endpoint: https://api.allegro.pl/sale/categories/0

Test tego endpointu powinien dać odpowiedź 404 zwracając tablicę z danymi błędu zawierającą poniższe obiekty.
```Json 
{
  "errors": [
    {
      "code": "NotFoundException",
      "message": "Not found",
      "details": null,
      "path": null,
      "userMessage": "Function is not available. Contact the author of the application."
    }
  ]
}

```

3. ### __GET parameters supported by a category, /sale/categories/{categoryId}/parameters__ 

__GET_parameters_supported.php__

testowany endpoint: https://api.allegro.pl/sale/categories/121882/parameters

Test dla powyższego endpointu powinien dać odpowiedź 200 zwracając tablicę z danymi zawierającą poniższe obiekty.
``` Json
{
  "parameters": [
    {
      "id": "202877",
      "name": "Liczba rdzeni procesora",
      "type": "integer",
      "required": false,
      "requiredForProduct": false,
      "unit": null,
      "options": {
        "variantsAllowed": true,
        "variantsEqual": false,
        "ambiguousValueId": null,
        "dependsOnParameterId": "202870",
        "requiredDependsOnValueIds": ["202870_1"],
        "displayDependsOnValueIds": ["202870_1", "202870_2"],
        "describesProduct": false,
        "customValuesEnabled": false
      },
      "restrictions": {
        "min": 0,
        "max": 1000000,
        "range": false
      }
    }
  ]
}
```

---
---
__GET_parameters_supported_error404.php__

testowany endpoint: https://api.allegro.pl/sale/categories/121882/parameterss

Test tego endpointu powinien dać odpowiedź 404 zwracając tablicę z danymi błędu zawierającą poniższe obiekty.
```Json 
{
  "errors": [
    {
      "code": "NotFoundException",
      "message": "Not found",
      "details": null,
      "path": null,
      "userMessage": "Function is not available. Contact the author of the application."
    }
  ]
}
```
