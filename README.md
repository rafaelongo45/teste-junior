## Quick installation

- Clone the repository  
- Install composer with:

      composer install
- Create a database in postgresql
- Create your .env file based on the .env.example
- Generate your database with: 
      
      php artisan migrate
- Run the server with:

      php artisan serve

### Routes

GET /api/v1/pessoa
 - Returns an array with all registered "pessoas".

GET /api/v1/pessoa/{id}
* Returns the information from "pessoa" with the selected id.

POST /api/v1/pessoa
* Creates a new "pessoa" in the database.

- fields:

    "nome": "lorem ipsum",

    "sobrenome": "lorem ipsum",

    "cpf": "99999999999",

    "celular": "99999999999",

    "logradouro": "lorem ipsum",

    "cep": "99999999"

PUT /api/v1/pessoa/{id}
* Updates information from "pessoa" with the selected id.

- fields:

    "nome": "lorem ipsum",

    "sobrenome": "lorem ipsum",

    "cpf": "99999999999",

    "celular": "99999999999",

    "logradouro": "lorem ipsum",

    "cep": "99999999"

DELETE /api/v1/pessoa/{id}
* Deletes information from "pessoa" with the selected id. 