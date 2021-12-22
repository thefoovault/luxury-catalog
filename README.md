# L U X U R Y ~ C A T A L O G
## Installation
Run `git clone` to download the repository and then, enter to the project folder and run `make build`.

This action will build, install all the required dependencies and create all necessary data. Also, it starts the application so once the command finishes you can start querying the endpoint.

### Prerequisites:
- You must have **[Docker](https://www.docker.com/)** installed and running in your computer
- Please make sure you have the following ports available on your computer:
    - `8000` (for the `Nginx` webserver)
    - `9200` (for the `Elasticsearch` service)

## Usage
In order to interact with this application you have to enter to the project folder via terminal and execute any of the following:

| Command      | Description                                       |
|--------------|---------------------------------------------------|
| `make start` | Starts the app                                    |
| `make stop`  | Stops the app (without destroying its containers) |
| `make test`  | Run all tests                                     |
| `make shell` | Opens an interactive shell in the main container  |
| `make`       | Show all available commands                       |


### How can I use this app?

This application exposes a single `GET` endpoint at [http://localhost:8000](http://localhost:8000).

Go to the `{PROJECT_FOLDER}/docs/endpoints/catalog.http` file, and you'll find some prepared requests.
- If you are using **PhpStorm**, the IDE will allow you to run each request when opening said file.
- If you prefer going with another HTTP client (like [Postman](https://www.postman.com/) or even a web-browser), the file contains all the necessary information to help you to create your own requests.

## Behind the scenes
Since the exercise must be scalable I chose a different approach instead of the typical Doctrine repository.

The exercise relies on the idea of **Projections**: I just assumed there would be another piece of software (placed in this same context or in another one) whose responsibility is to maintain Products (create, edit, delete).
When said piece performs a change (by creating, modifying or deleting any Product), a domain event is triggered and a projection is created in the Infrastructure layer (`Elasticsearch`).

*Please note that piece is **NOT IMPLEMENTED** because the exercise only cares about readings, not savings*.

### Why following the Projection approach?
Because projections are faster than simply querying the database (since they contain all the needed information in one single place) and the exercise wants scalability.
Also, using `Elasticsearch` as infrastructure allows the project to offer an excellent performance because that engine is prepared to handle a lot of queries.

So, we can focus our hypothetical `MySQL` database on only adding information about Products without compromising the endpoint.

Of course, we need events to update our Projections and this can lead us to some inconsistencies because the little delay needed to synchronize `Elasticsearch`.

### What about filtering the queries?
I used the `Criteria` pattern to make the requests more flexible: this allows to add more filters without modifying the repository contract and the code is more maintainable (also, we respect the OCP).

### What Design Patterns did I use?
Besides of all the bunch of patterns needed in the Hexagonal architecture, I used the `Strategy` and `Factory method` patterns:
- Since we have different types of discounts, the `Strategy` allows us to easily create and maintain all the required types.
- Being that we have different discounts strategies, we need a `Factory method` capable to instantiate the required strategy.

## Last words
- I used **Symfony** as framework due to its high performance and scalability in a decoupled way.
- For the discount strategies I used an `InMemory` repository in order to keep simple the project.
    - In said repository you'll find the `discountStrategiesOrderedByPercentage` method which in fact does not order anything because the strategies are already sorted.
- I think a `Paginator` would be a great feature, but I chose to focus on the main goal. 
