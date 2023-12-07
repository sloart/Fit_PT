use Fit_PT;

create table if not exists system_users
	(
		user_id int primary key unique auto_increment,
		user_name varchar(60) unique not null,
		user_email varchar(60) unique not null,
		user_password varchar(255) not null,
		user_type varchar(5) not null
		-- user_certs varchar(75) null
	);

-- !!! DEFAULT PASSWORD FOR THESE ACCOUNTS IS Passw0rd - so we can log in for testing !!!
insert into system_users
values
	(default,'Abraham','abraham@fitpt.com', "$2y$10$un.7LLhYQkD1ooBWFhXH8uImn8MzGr7IMsqvPzKAKOidkQMUQG5r6",'t'),
	(default,'Aeshia','aeshia@fitpt.com', "$2y$10$un.7LLhYQkD1ooBWFhXH8uImn8MzGr7IMsqvPzKAKOidkQMUQG5r6",'t'),
	(default,'April','april@fitpt.com', "$2y$10$un.7LLhYQkD1ooBWFhXH8uImn8MzGr7IMsqvPzKAKOidkQMUQG5r6",'t'),
	(default,'Art','art@fitpt.com', "$2y$10$un.7LLhYQkD1ooBWFhXH8uImn8MzGr7IMsqvPzKAKOidkQMUQG5r6",'t'),
	(default,'Becky','becky@fitpt.com', "$2y$10$un.7LLhYQkD1ooBWFhXH8uImn8MzGr7IMsqvPzKAKOidkQMUQG5r6",'t'),
	(default,'Carmen','carmen@fitpt.com', "$2y$10$un.7LLhYQkD1ooBWFhXH8uImn8MzGr7IMsqvPzKAKOidkQMUQG5r6",'t'),
	(default,'Cole','cole@fitpt.com', "$2y$10$un.7LLhYQkD1ooBWFhXH8uImn8MzGr7IMsqvPzKAKOidkQMUQG5r6",'t'),
	(default,'Dennis','dennis@fitpt.com', "$2y$10$un.7LLhYQkD1ooBWFhXH8uImn8MzGr7IMsqvPzKAKOidkQMUQG5r6",'t'),
	(default,'Jade','jade@fitpt.com', "$2y$10$un.7LLhYQkD1ooBWFhXH8uImn8MzGr7IMsqvPzKAKOidkQMUQG5r6",'t'), 
	(default,'June','june@fitpt.com', "$2y$10$un.7LLhYQkD1ooBWFhXH8uImn8MzGr7IMsqvPzKAKOidkQMUQG5r6",'t'), 
	(default,'Kennan','kennan@fitpt.com', "$2y$10$un.7LLhYQkD1ooBWFhXH8uImn8MzGr7IMsqvPzKAKOidkQMUQG5r6",'t'), 
	(default,'Larry','larry@fitpt.com', "$2y$10$un.7LLhYQkD1ooBWFhXH8uImn8MzGr7IMsqvPzKAKOidkQMUQG5r6",'t'),
	(default,'Latesha','latesha@fitpt.com', "$2y$10$un.7LLhYQkD1ooBWFhXH8uImn8MzGr7IMsqvPzKAKOidkQMUQG5r6",'t'),
	(default,'Mary','mary@fitpt.com', "$2y$10$un.7LLhYQkD1ooBWFhXH8uImn8MzGr7IMsqvPzKAKOidkQMUQG5r6",'t'),
	(default,'Mario','mario@fitpt.com', "$2y$10$un.7LLhYQkD1ooBWFhXH8uImn8MzGr7IMsqvPzKAKOidkQMUQG5r6",'t'),
	(default,'Nathan','nathan@fitpt.com', "$2y$10$un.7LLhYQkD1ooBWFhXH8uImn8MzGr7IMsqvPzKAKOidkQMUQG5r6",'t'),
	(default,'Orlando','orlando@fitpt.com', "$2y$10$un.7LLhYQkD1ooBWFhXH8uImn8MzGr7IMsqvPzKAKOidkQMUQG5r6",'t'),
	(default,'Rick','rick@fitpt.com', "$2y$10$un.7LLhYQkD1ooBWFhXH8uImn8MzGr7IMsqvPzKAKOidkQMUQG5r6",'t'),
	(default,'Sarah','sarah@fitpt.com', "$2y$10$un.7LLhYQkD1ooBWFhXH8uImn8MzGr7IMsqvPzKAKOidkQMUQG5r6",'t'),
	(default,'Sasha','sasha@fitpt.com', "$2y$10$un.7LLhYQkD1ooBWFhXH8uImn8MzGr7IMsqvPzKAKOidkQMUQG5r6",'t'),
	(default,'Wilbur','wilbur@fitpt.com', "$2y$10$un.7LLhYQkD1ooBWFhXH8uImn8MzGr7IMsqvPzKAKOidkQMUQG5r6",'t');