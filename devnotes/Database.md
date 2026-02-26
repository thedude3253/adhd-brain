# Structure
* PUBLIC.USER table // stores user information
	* UUID PK
	* DISPLAYNAME
* AUTH.USER table // stores authentication info
	* USERNAME PK
	* BCRYPT // stores salt, cost, and hash all in one go
	* USER_UUID
* AUTH.SESSION table
	* SESSION_UUID PK
	* USER_UUID
	* SESSION_IP
	* SESSION_START timestamp
	* SESSION_HEARTBEAT timestamp // Updates every time the user in this session performs an action on the server
	* SESSION_VALID boolean // Should go to false when its been an hour since the last heartbeat, the user requests to invalidate all sessions, or the user presses the log out button.
* AUTH.API table // stores information on valid api keys
	* UUID PK
	* BCRYPT
* PUBLIC.PROJECT table // stores project information
	* UUID PK
	* NAME
	* OWNER_UUID
	* DESCRIPTION
* PUBLIC.PERMISSIONS table // stores permissions per user per project
	* PROJECT_UUID / USER_UUID composite key
	* PERMS (json string)
* PUBLIC.TASK table // stores information about tasks tied to a project
	* ID / PROJECT_UUID composite key
	* USER_UUID // UUID of the user account that generated the task
	* STATUS // ENUM (new, in progress, complete)
* PUBLIC.NOTE table // stores non-task information about a project
	* ID / PROJECT_UUID composite key
	* NOTE // TEXT containing the note
# Schemas
## public
For storing information that is generally accessible
## auth
For storing data and functions related to user and session authentication
# Permissions
```json
{
	"canView": true,
	"canDelete": true,
	"canModify": true,
	"noteAccess": {
		"canCreate": true,
		"canModify": true,
		"canDelete": true
	},
	"taskAccess": {
		"canCreate": true,
		"canModify": true,
		"canMove": true,
		"canDelete": true
	}
}
```
Very simply a nested set of boolean values