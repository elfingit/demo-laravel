<a name="top"></a>
# BLV API v1.0.0

Api docs

- [Brands](#Brands)
	- [Get brand data](#Get-brand-data)
	- [Get brand results](#Get-brand-results)
	- [Get list of brands](#Get-list-of-brands)
	
- [Leads](#Leads)
	- [Create lead](#Create-lead)
	- [update lead](#update-lead)
	

# <a name='Brands'></a> Brands

## <a name='Get-brand-data'></a> Get brand data
[Back to top](#top)



```
GET /api/v1/brands/:brand
```

### Parameter Parameters
| Name     | Type       | Description                           |
|:---------|:-----------|:--------------------------------------|
| brand | `String` | <p>code of brand</p> |

### Success Response
Success-Response:

```
 HTTP/1.1 200 OK
 {
     "data":
			{
				"id": "us_powerball",
				"name": "Powerball",
				"logo": "http://localhost/images/logos/us_powerball-logo.png",
				"jackpot_multiplier": true,
				"number_shield": true,
				"default_quick_pick": [
				    "3"
				],
				"primary_pool": 69,
				"primary_pool_combination": 5,
				"special_pool": 26,
				"special_pool_combination": 1,
				"name_of_special_pool": "Powerball",
				"duration": true,
				"subscription": true,
				"jackpot_hut": true,
				"participation": true,
				"extra_game": true,
				"tickets_count": 6
			}
	}
```

### Success 200
| Name     | Type       | Description                           |
|:---------|:-----------|:--------------------------------------|
| id | `String` | <p>code of brand</p> |
| name | `String` | <p>name of brand</p> |
| logo | `String` | <p>url of brand logo</p> |
| jackpot_multiplier | `Boolean` |  |
| default_quick_pick | `String[]` |  |
| primary_pool | `Number` |  |
| primary_pool_combination | `Number` |  |
| special_pool | `Number` |  |
| special_pool_combination | `Number` |  |
| name_of_special_pool | `String` |  |
| duration | `Boolean` |  |
| jackpot_hut | `Boolean` |  |
| participation | `Boolean` |  |
| extra_game | `Boolean` |  |
| tickets_count | `Number` |  |

### Error Response
Error-Response:

```
HTTP/1.1 404 Not Found
{
    "message": "Not found"
}
```
## <a name='Get-brand-results'></a> Get brand results
[Back to top](#top)



```
GET /api/v1/brands/:brand/results
```

### Parameter Parameters
| Name     | Type       | Description                           |
|:---------|:-----------|:--------------------------------------|
| brand | `String` | <p>code of brand</p> |

### Success Response
Success-Response:

```
 HTTP/1.1 200 OK
 {
     "data":[
			{
				"draw_date": "2019-07-06",
				"results": {
	                "main_result": [
                     "04",
                     "08",
                     "23",
                     "46",
                     "65"
                 ]
             },
				"extra_ball": "01",
				"additional_games": {
				    "megaplier": "2"
				}
			}
     ]
	}
```

### Success 200
| Name     | Type       | Description                           |
|:---------|:-----------|:--------------------------------------|
| draw_date | `String` |  |
| results | `Object` |  |
| extra_ball | `String` |  |
| additional_games | `Object` |  |

### Error Response
Error-Response:

```
HTTP/1.1 404 Not Found
{
    "message": "Not found"
}
```
## <a name='Get-list-of-brands'></a> Get list of brands
[Back to top](#top)



```
GET /api/v1/brands
```


### Success Response
Success-Response:

```
 HTTP/1.1 200 OK
 {
     "data": [
			{
				"id": "us_powerball",
				"name": "Powerball",
				"logo": "http://localhost/images/logos/us_powerball-logo.png"
			}
		]
	}
```

### Success 200
| Name     | Type       | Description                           |
|:---------|:-----------|:--------------------------------------|
| id | `String` | <p>code of brand</p> |
| name | `String` | <p>name of brand</p> |
| logo | `String` | <p>url of brand logo</p> |
# <a name='Leads'></a> Leads

## <a name='Create-lead'></a> Create lead
[Back to top](#top)



```
POST /api/v1/leads
```

### Parameter Parameters
| Name     | Type       | Description                           |
|:---------|:-----------|:--------------------------------------|
| host | `String` | <p>Name of host</p> |
| g_user_id | `String` | <p>Google Analytics User ID</p> |
| cart_items | `Object[]` | **optional** |

### Success Response
Success-Response:

```
 HTTP/1.1 200 OK
 {
     "data": {
				"id": 3,
				"cart_items": [{
					"brand_id": "us_powerball",
					"tickets": [3,4,5,6,23]
				}]
			}
	}
```

### Success 200
| Name     | Type       | Description                           |
|:---------|:-----------|:--------------------------------------|
| id | `Number` | <p>ID of lead</p> |
| cart_items | `Object[]` |  |

### Error Response
Error-Response:

```
 HTTP/1.1 422 Unprocessable Entity
 {
     "message": "The given data was invalid.",
		"errors": {
			"host": [
				"The host field is required."
			],
			"g_user_id": [
				"The g user id field is required."
			]
		}
 }
```
## <a name='update-lead'></a> update lead
[Back to top](#top)



```
PUT /api/v1/leads/:lead
```

### Parameter Parameters
| Name     | Type       | Description                           |
|:---------|:-----------|:--------------------------------------|
| host | `String` | <p>Name of host</p> |
| cart_items | `Object[]` |  |

### Success Response
Success-Response:

```
 HTTP/1.1 200 OK
 {
     "data": {
				"id": 3,
				"cart_items": [{
					"brand_id": "us_powerball",
					"tickets": [3,4,5,6,23]
				}]
			}
	}
```

### Success 200
| Name     | Type       | Description                           |
|:---------|:-----------|:--------------------------------------|
| id | `Number` | <p>ID of lead</p> |
| cart_items | `Object[]` |  |

### Error Response
Error-Response:

```
 HTTP/1.1 422 Unprocessable Entity
 {
     "message": "The given data was invalid.",
		"errors": {
			"host": [
				"The host field is required."
			],
			"cart_items": [
				"The cart items field is required."
			]
		}
 }
```
