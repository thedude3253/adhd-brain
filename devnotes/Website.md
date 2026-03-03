# Main Page/"Dashboard"
* Header
	* Logo
	* Quick Links
	* Login Button/Username Badge
* Body
	* If not logged in:
		* Explanation of the project and how to get started
	* Else:
		* List of all Projects the user has permissions to view, with sorting features
# Login/User Page
* Header
	* Logo
	* Quick Links
* Body
	* If logged in:
		* Display name (with edit button if this is your page)
		* Maybe an about me section?
	* Else:
		* Username and password fields
		* Login button
		* Signup Page link
# Signup Page
* Header
	* Logo
	* Quick Links
* Body
	* If logged in:
		* Auto redirect to User page
	* Else:
		* Username and password fields
		* Confirm password field
		* Signup Button
		* Message on 403 error, with login link
# Project Page
* Header
	* Logo
	* Quick Links
* Body
	* If not logged in/no permissions:
		* 403 Error Page
	* If Session Invalid:
		* Redirect to Login page
	* Else:
		* Project tab
			* Project name (with edit button if perms)
			* Project description (with edit button if perms)
		* Tasks tab
			* Task bubbles showing the name
			* 3 columns (New, In Progress, Complete)
			* Draggable interface to move tasks between the options