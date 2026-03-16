# Notes
/projects and /project could be merged, simply make the project UUID optional and default to returning all projects the user has access to.
# TODO
* Finish writing documentation for /task api
* Finish writing documentation for /note api
* Write documentation for /session api
# General Structure
* API path
* Name
* HTTP method
	* Description
	* Required Permissions
	* JSON return format
# /user
**User Operations**
## GET
Get available information about a user
**Parameters**
```
user: UUID of the requested user
```
**Permissions**
`None`
**Return**
404 on invalid user_uuid, otherwise:
`200`
```JSON
{
	"displayname": "",
	"online": boolean
}
```
## POST
Create an account
**Parameters**
```
username: desired username
password: desired password (a real implementation should be using HTTPS to prevent man in the middle attacks)
```
**Permissions**
`None`
**Return**
409 if username is not unique, otherwise:
`201`
# /auth
**Authenticate User**
## POST
Validate a username and password combination. If it's valid, start a new session for that user.
**Parameters**
```
username: The username tied to the request
password: The password in plaintext (A real implementation of this site should be using HTTPS to prevent man in the middle attacks)
```
**Permissions**
`None`
**Return**
401 on wrong username/password combo, otherwise:
`200`
```JSON
{
	"session_uuid": ""
}
```

# /projects
**Get Projects**
## GET
Returns a list of all of the projects that should be visible to the client.
**Parameters**
```
session: The session UUID attached to this request
filter (optional): boolean, if we are looking for all available projects, or just the ones owned by the client
```
**Permissions**
`None`
**Return**
401 on invalid session, otherwise:
`200`
```JSON
{
	"ProjectA": {"UUID": "", "name": "", "desc": "", "owner": ""},
	"ProjectB": {"UUID": "", "name": "", "desc": "", "owner": ""}
}
```

# /project
**Project Operations**
## GET
Returns all of the information on a specific project
**Parameters**
```
username: The username of the profile attached to the request
project: The UUID of the project
```
**Permissions**
`canRead`
**Returns**
401 on invalid session, 403 on lack of permissions, 404 if project does not exist, otherwise:
`200`
```JSON
{
	"name": "",
	"desc": "",
	"tasks": ["UUID1", "UUID2"],
	"notes": ["UUID1", "UUID2"]
}
```
## POST
Creates a new project
**Parameters**
```
session: The session UUID attached to this request
name: The desired name for the project
desc: The desired description for the project
```
**Permissions**
`None`
**Returns**
401 on invalid session, otherwise:
`201`
```JSON
{
	"project_uuid": ""
}
```
## DELETE
Deletes the specified project
**Parameters**
```
session: The session UUID attached to this request
project: The UUID of the project
```
**Permissions**
`canDelete`
**Returns**
401 on invalid session, 403 on lack of permissions, otherwise:
`200`
# /task
**Task Operations**
## GET
Gets task information
## POST
Creates a new task for a given project
## DELETE
Deletes a task from the database
# /note
**Note Operations**
## GET
Gets note information
## POST
Creates a new note for a given project
## DELETE
Deletes a note from the database