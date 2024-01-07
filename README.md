<!-- Improved compatibility of back to top link: See: https://github.com/othneildrew/Best-README-Template/pull/73 -->
<a name="readme-top"></a>
<!--
*** Thanks for checking out the Best-README-Template. If you have a suggestion
*** that would make this better, please fork the repo and create a pull request
*** or simply open an issue with the tag "enhancement".
*** Don't forget to give the project a star!
*** Thanks again! Now go create something AMAZING! :D
-->



<!-- PROJECT SHIELDS -->
<!--
*** I'm using markdown "reference style" links for readability.
*** Reference links are enclosed in brackets [ ] instead of parentheses ( ).
*** See the bottom of this document for the declaration of the reference variables
*** for contributors-url, forks-url, etc. This is an optional, concise syntax you may use.
*** https://www.markdownguide.org/basic-syntax/#reference-style-links
-->
[![Contributors][contributors-shield]][contributors-url]
[![Forks][forks-shield]][forks-url]
[![Stargazers][stars-shield]][stars-url]
[![Issues][issues-shield]][issues-url]
[![MIT License][license-shield]][license-url]
[![LinkedIn][linkedin-shield]][linkedin-url]



<!-- PROJECT LOGO -->
<br />
<div align="center">
  <a href="https://github.com/Mohamed-Zhran/wassalny">
    <img src="images/logo.png" alt="Logo" width="80" height="80">
  </a>

<h3 align="center">Wassalny</h3>

  <p align="center">

    User Profiles:
        Create and manage your profile with essential information such as name, photo, and ride preferences.
        Browse through other users' profiles to find compatible ride-sharing partners.

    Trips Management:
        Easily plan and schedule your trips, specifying your starting point, destination, and preferred time.
        Join existing trips or create your own, allowing others to join and share the journey.

    Car Listings:
        Register your car on the platform, providing details like make, model, and seating capacity.
        Users can search for available cars based on their preferences and choose the most convenient option.

    Address Integration:
        Utilize advanced address mapping to accurately pinpoint pick-up and drop-off locations.
        Seamless integration with mapping services ensures smooth navigation during the entire ride.

    Unit Testing:
        Our platform is built with a robust unit testing framework to ensure reliability and functionality.
        Continuous testing practices guarantee that updates and new features do not compromise the overall user experience.

    Repository Layer:
        Our application follows a structured repository layer, ensuring efficient data access and management.
        Data operations are cleanly separated, enhancing maintainability and scalability.

    Service Layer:
        The service layer encapsulates business logic, promoting a modular and organized codebase.
        It facilitates the smooth flow of information between the user interface and the data repository.

Join us in creating a community where sharing rides is not only convenient but also contributes to a greener and more sustainable future.
    <br />
    <a href="https://github.com/Mohamed-Zhran/wassalny"><strong>Explore the docs »</strong></a>
    <br />
    <br />
    <a href="https://github.com/Mohamed-Zhran/wassalny">View Demo</a>
    ·
    <a href="https://github.com/Mohamed-Zhran/wassalny/issues">Report Bug</a>
    ·
    <a href="https://github.com/Mohamed-Zhran/wassalny/issues">Request Feature</a>
  </p>
</div>



<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#usage">Usage</a></li>
    <li><a href="#roadmap">Roadmap</a></li>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#license">License</a></li>
    <li><a href="#contact">Contact</a></li>
    <li><a href="#acknowledgments">Acknowledgments</a></li>
  </ol>
</details>




### Built With

* [![Laravel][Laravel.com]][Laravel-url]

<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- GETTING STARTED -->
## Getting Started

This is an example of how you may give instructions on setting up your project locally.
To get a local copy up and running follow these simple example steps.

### Prerequisites

This is an example of how to list things you need to use the software and how to install them.
* docker

### Installation

1. Clone the repo
   ```sh
   git clone https://github.com/Mohamed-Zhran/wassalny.git
   ```
2. change directory
   ```sh
   cd wassalny
   ```
3. create .env file
   ```sh
   cp src/.env.example src/.env
   ```
4. install composer packages
   ```sh
   docker compose exec app -it composer install
   ```
5. run test cases
   ```sh
   docker compose exec app -it php artisan test
   ```
6. run migration and seeders
   ```sh
    docker compose exec app php artisan migrate --seed
   ```
7. run docker compose
   ```sh
   docker compose up -d
   ```
8. Enter your API in `config.js`
   ```
    DB_CONNECTION=mysql
    DB_HOST=mysql
    DB_PORT=3306
    DB_DATABASE=wassalny
    DB_USERNAME=root
    DB_PASSWORD=secret
    BROADCAST_DRIVER=redis
    CACHE_DRIVER=redis
    REDIS_CLIENT=predis
    QUEUE_CONNECTION=redis
   ```

<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- ROADMAP -->
## Roadmap

- [x] User Signup and Signin using sanctum
- [x] Cars crud operations with validations using policies
- [x] trips crud operations
    - [x] booking trips

See the [open issues](https://github.com/Mohamed-Zhran/wassalny/issues) for a full list of proposed features (and known issues).

<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- CONTRIBUTING -->
## Contributing

Contributions are what make the open source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

If you have a suggestion that would make this better, please fork the repo and create a pull request. You can also simply open an issue with the tag "enhancement".
Don't forget to give the project a star! Thanks again!

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- LICENSE -->
## License

Distributed under the MIT License. See `LICENSE.txt` for more information.

<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- CONTACT -->
## Contact

Mohamed Zhran - mohamedzhran100@gmail.com

Project Link: [https://github.com/Mohamed-Zhran/wassalny](https://github.com/Mohamed-Zhran/wassalny)

<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->
[contributors-shield]: https://img.shields.io/github/contributors/Mohamed-Zhran/wassalny.svg?style=for-the-badge
[contributors-url]: https://github.com/Mohamed-Zhran/wassalny/graphs/contributors
[forks-shield]: https://img.shields.io/github/forks/Mohamed-Zhran/wassalny.svg?style=for-the-badge
[forks-url]: https://github.com/Mohamed-Zhran/wassalny/network/members
[stars-shield]: https://img.shields.io/github/stars/Mohamed-Zhran/wassalny.svg?style=for-the-badge
[stars-url]: https://github.com/Mohamed-Zhran/wassalny/stargazers
[issues-shield]: https://img.shields.io/github/issues/Mohamed-Zhran/wassalny.svg?style=for-the-badge
[issues-url]: https://github.com/Mohamed-Zhran/wassalny/issues
[license-shield]: https://img.shields.io/github/license/Mohamed-Zhran/wassalny.svg?style=for-the-badge
[license-url]: https://github.com/Mohamed-Zhran/wassalny/blob/master/LICENSE.txt
[linkedin-shield]: https://img.shields.io/badge/-LinkedIn-black.svg?style=for-the-badge&logo=linkedin&colorB=555
[linkedin-url]: https://linkedin.com/in/linkedin_username
[product-screenshot]: images/screenshot.png
[Next.js]: https://img.shields.io/badge/next.js-000000?style=for-the-badge&logo=nextdotjs&logoColor=white
[Next-url]: https://nextjs.org/
[React.js]: https://img.shields.io/badge/React-20232A?style=for-the-badge&logo=react&logoColor=61DAFB
[React-url]: https://reactjs.org/
[Vue.js]: https://img.shields.io/badge/Vue.js-35495E?style=for-the-badge&logo=vuedotjs&logoColor=4FC08D
[Vue-url]: https://vuejs.org/
[Angular.io]: https://img.shields.io/badge/Angular-DD0031?style=for-the-badge&logo=angular&logoColor=white
[Angular-url]: https://angular.io/
[Svelte.dev]: https://img.shields.io/badge/Svelte-4A4A55?style=for-the-badge&logo=svelte&logoColor=FF3E00
[Svelte-url]: https://svelte.dev/
[Laravel.com]: https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white
[Laravel-url]: https://laravel.com
[Bootstrap.com]: https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white
[Bootstrap-url]: https://getbootstrap.com
[JQuery.com]: https://img.shields.io/badge/jQuery-0769AD?style=for-the-badge&logo=jquery&logoColor=white
[JQuery-url]: https://jquery.com