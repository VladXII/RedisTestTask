### Startup project

- install docker and docker-compose
- cd into root directory
- run ``docker-compose up``

### User api
After startup api available at ```http://localhost:8080```

There are two api methods:

- Save string into redis (notice: key - generated uuid):

```
method post: http://localhost:8080/string
post params:
value - string

```

- Get value by key:

```
method get: http://localhost:8080/string/{key}
url params:
key - string

```
  