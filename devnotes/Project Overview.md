ADHD-Brain is a project that will be a portfolio project to put on my github. Thus, it needs to be well thought out from the beginning so that its well-architected and clean.

# Core Concept
ADHD-Brain (which I will simply call AB from now on) is going to be a web-based tool for managing personal projects, note-taking, and managing task lists within those projects.
It will need to showcase my abilities with:
* PHP (For serving web-pages)
* Java (REST apis)
* Springboot
* PostgreSQL
* Basic Auth

# Architecture
AB will be split into three main sections:
* Backend Java API server to talk to database
* PHP server to talk to browser and talk to API server (guaranteeing database access can only be done by official requests)
* PostgreSQL database
## Reasons to split up the servers
* I want to show proficiency with Java and PHP without writing multiple projects
* Allows for independent scaling of UI and API servers
* Added security (see security section)
* Maintainability
	* Theoretically allows the UI and API to be maintained by separate teams
	* Allows for no downtime for the user if the API is updated
	* Easy compartmentalization of tasks
* Allows for caching (multiple users could request the same API call at the same time, we could use a single api call and then provide it for all of the UI calls)
* Allows us to flex the strengths of each language
# Security
Security is a nightmare topic. There's no way to be 100% safe but there are some things we can do to mitigate risk.
* Password salting+hashing using a slow algorithm like bcrypt
	* Self-explanatory, you don't want to store plaintext passwords on the database
	* Prevents (or severely hampers)
		* Security loss from database leaks
		* Dictionary attacks
		* Rainbow table attacks
* IP authentication
	* Session UUIDs should have an associated ip address, if the ip doesn't match its coming from some unauthenticated source
	* Prevents (or severely hampers)
		* *Some* MITM attacks
		* Attacks from grabbing someone's cookies (local virus or some other such vector)
* Server authentication
	* API requests should only be acknowledged if coming from a known source (the PHP server, dev/admin with an api key, etc)
	* Prevents (or severely hampers)
		* *Some* MITM attacks
* HTTPS
	* The piece of the puzzle that makes this all work smoothly, sometimes things need to be sent over plaintext (password attempt, session id, etc) and we don't want that to be seen
	* Prevents (or severely hampers)
		* MITM attacks
# General Flow
1. User connects to PHP on port 80
2. PHP sends page
3. User interacts with webpage 
4. requests are sent to PHP server
5. PHP server verifies identity and sends requests onto Springboot server (port 8080)
6. Springboot server verifies PHP server identity and responds (with possible db contact)