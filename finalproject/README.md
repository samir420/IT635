
A Customer Management System has been created using PHP and Mysql.

Midterm Deliverables:


Individual deliverables:

Employee login:
	View client company list
	Search by business type / service / keyword
		View company details
		Provide notes about company
		View company contacts list
			Add company contact dossier
	View / search contacts
manager login:
	Add /remove a new client company to the list of available


Common deliverables:

	Apply First, second, and third normal forms to all data in the database
	Functioning web interface
	User Authentication - With Admin and user levels
	All user security information needs to be hashed
	All database data, sql files, and source code put into git



Final Deliverables:

	Live Replications with M/S on a second VM
	Scheduled Incremental Backups (With Backup Rotation)
	Reimplement one of your tables in Mongo (mlab or run it locally)
	Enforce the first three normal forms on your MYSQL database
	Implement one of your common queries as a stored procedure
	Document your database layout in UML
	All midterm deliverables are still required


Stored Procedure:
	getusers($username); // this stored procedure is running in all php files
	// It gets the firstname and lastname based on the username

MongoDB:
	"Add note" feature on the website is implemented using MongoDB.

Increment Backups with Rotation:
	//Binary logs are enabled in the server
	//Expire date set to 10 days
	//mysqldump.sh scripts flushes the logs before creating a full backup of the client database.
	//the script is added in crontab to run once a day.

Live Replication:
	//Another instance of AWS has been created.
	//Added Configuration to read Master binary logs
	//Started the slave

