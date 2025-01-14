# ![JMP](logo.png)

[![Build Status](https://travis-ci.com/jmp-app/jmp.svg?branch=master)](https://travis-ci.com/jmp-app/jmp)
[![Maintainability](https://api.codeclimate.com/v1/badges/600b1583b9c1bb08a7f5/maintainability)](https://codeclimate.com/github/jmp-app/jmp/maintainability)
[![FOSSA Status](https://app.fossa.io/api/projects/git%2Bgithub.com%2Fjmp-app%2Fjmp.svg?type=shield)](https://app.fossa.io/projects/git%2Bgithub.com%2Fjmp-app%2Fjmp?ref=badge_shield)

# Demo
**Link:** [jmp-app.tk](https://jmp-app.tk)  
**Username:** adam  
**Password:** pass4dev  
**Backend Pipeline:** [![buddy pipeline](https://app.buddy.works/jmp-app/jmp/pipelines/pipeline/194289/badge.svg?token=8487ee3804e9492d87e9404caa89b3daedc7abd96362150550ba04dc521f0d89 "buddy pipeline")](https://app.buddy.works/jmp-app/jmp/pipelines/pipeline/194289)  
**Frontend Pipeline:** [![buddy pipeline](https://app.buddy.works/jmp-app/jmp/pipelines/pipeline/195159/badge.svg?token=8487ee3804e9492d87e9404caa89b3daedc7abd96362150550ba04dc521f0d89 "buddy pipeline")](https://app.buddy.works/jmp-app/jmp/pipelines/pipeline/195159)

# Table of Contents:
- [JMP](#jmplogopng)
- [Getting Started](#getting-started)
  * [Prerequisites](#prerequisites)
  * [Installation](#installation)
  * [Manual Installation](#manual-installation)
    + [Development environment](#development-environment)
    + [Production environment](#production-environment)
  * [Development](#documentation--development)
    + [Frontend](#frontend)
    + [Backend](#backend)
- [Authors](#authors)
- [License](#license)

# Getting Started

## Prerequisites

**Required:**
 * [docker](https://www.docker.com/)

**Recommended:**
 * [GNU Make](https://www.gnu.org/software/make/)

## Installation

Clone the repository
```bash
git clone https://github.com/jmp-app/jmp.git
cd jmp
```

To run the development environment you only need run the following Make target:

````bash
make setup-dev
````

or for the production environment:

````bash
make setup-prod
````

**Note:**
* For a real production environment you need to adjust all the environment variables properly. See [dotenv](docs/dotenv.md).

## Manual Installation

There is also a Makefile accessible for the most common tasks: [Makefile](Makefile)  
Run `make help` for more information.

Clone the repository
```bash
git clone https://github.com/jmp-app/jmp.git
cd jmp
```

Create the following `.env` and configuration files from its corresponding example files:
* [vue/jmp.config.js](vue/jmp.config.js)
* [db.env](db.env)
* [api/db.env](api/db.env)
* [api/.env](api/.env)

Read more about all variables at [dotenv](docs/dotenv.md)

### Development environment

Build vue
```bash
docker-compose -f vue-build.yml run npm
```
**Note:**
* To run vue at development with a local installation of npm, read this [documentation](vue/README.md)

Build and start the docker containers
```bash
docker-compose up -d --build
```

Install all the dependencies using the composer of the app container
````bash
docker exec app composer install
````

### Production environment

Build and start the docker containers
````bash
docker-compose -f docker-compose.prod.yml up -d --build
````

You can now access the frontend at [http://localhost](http://localhost) and the api at [http://localhost/api](http://localhost/api)

## Documentation & Development

**Check the [documentation](docs/README.md) for further information.**

### Frontend

Everything related to the frontend is located in [vue](vue). The frontend is built with **[Vue.js](https://vuejs.org/)**.
### Backend

Everything related to the backend is located in [api](api). The backend uses the **[Slim Framework](https://www.slimframework.com/)**.


# Authors

- Simon Friedli - [@Simai00](https://github.com/Simai00)
- Dominik Strässle - [@dominikstraessle](https://github.com/dominikstraessle)
- Kay Mattern - [@mtte](https://github.com/mtte)

# License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.


[![FOSSA Status](https://app.fossa.io/api/projects/git%2Bgithub.com%2Fjmp-app%2Fjmp.svg?type=large)](https://app.fossa.io/projects/git%2Bgithub.com%2Fjmp-app%2Fjmp?ref=badge_large)