<?php
// Set the database access information as constants:
DEFINE('DB_USER', 'root');
DEFINE('DB_PASSWORD', '');
DEFINE('DB_HOST', 'localhost');

// Establish a connection to MySQL without selecting a database:
$connection = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);

if (!$connection) {
    die('Could not connect to MySQL: ' . mysqli_connect_error());
}

// Create a new database name and check if it already exists:
$newDatabaseName = 'Fit_PT';

// Check if the database exists
$databaseExists = mysqli_select_db($connection, $newDatabaseName);

// If the database doesn't exist, create it:
if (!$databaseExists) {
    $createDatabaseQuery = "CREATE DATABASE $newDatabaseName";

    if (mysqli_query($connection, $createDatabaseQuery)) {
        //echo "Database created successfully";

        // Now, select the newly created database
        mysqli_select_db($connection, $newDatabaseName);

        // Create the "users" table with "email" and "password" columns
        $createUsersTableQuery = "CREATE TABLE users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL
        )";

        if (mysqli_query($connection, $createUsersTableQuery)) {
            //echo "<br>Table 'users' created successfully";
        } else {
            //echo "<br>Error creating table 'users': " . mysqli_error($connection);
        }

        // Create the "system_users" aka table query.
        $createSystemUsersTableQuery = "create table if not exists system_users
        (
            user_id int primary key unique auto_increment,
            user_name varchar(60) unique not null,
            user_email varchar(60) unique not null,
            user_password varchar(255) not null,
            user_type varchar(5) not null
        );";

        // Setting default password for default users to 'Passw0rd'.
        $defaultTestingPassword = 'Passw0rd';
        $hashedDefaultTestingPassword = password_hash($defaultTestingPassword, PASSWORD_DEFAULT);

        // Populate the system users table -only once
        $populateSystemUsersTableQuery = "insert into system_users
        values
            (default,'Abraham','abraham@fitpt.com','" . $hashedDefaultTestingPassword . "','t'),
            (default,'Aeshia','aeshia@fitpt.com','" . $hashedDefaultTestingPassword . "','t'),
            (default,'April','april@fitpt.com','" . $hashedDefaultTestingPassword . "','t'),
            (default,'Art','art@fitpt.com','" . $hashedDefaultTestingPassword . "','t'),
            (default,'Becky','becky@fitpt.com','" . $hashedDefaultTestingPassword . "','t'),
            (default,'Carmen','carmen@fitpt.com','" . $hashedDefaultTestingPassword . "','t'),
            (default,'Cole','cole@fitpt.com','" . $hashedDefaultTestingPassword . "','t'),
            (default,'Dennis','dennis@fitpt.com','" . $hashedDefaultTestingPassword . "','t'),
            (default,'Jade','jade@fitpt.com','" . $hashedDefaultTestingPassword . "','t'), 
            (default,'June','june@fitpt.com','" . $hashedDefaultTestingPassword . "','t'), 
            (default,'Kennan','kennan@fitpt.com','" . $hashedDefaultTestingPassword . "','t'), 
            (default,'Larry','larry@fitpt.com','" . $hashedDefaultTestingPassword . "','t'),
            (default,'Latesha','latesha@fitpt.com','" . $hashedDefaultTestingPassword . "','t'),
            (default,'Mary','mary@fitpt.com','" . $hashedDefaultTestingPassword . "','t'),
            (default,'Mario','mario@fitpt.com','" . $hashedDefaultTestingPassword . "','t'),
            (default,'Nathan','nathan@fitpt.com','" . $hashedDefaultTestingPassword . "','t'),
            (default,'Orlando','orlando@fitpt.com','" . $hashedDefaultTestingPassword . "','t'),
            (default,'Rick','rick@fitpt.com','" . $hashedDefaultTestingPassword . "','t'),
            (default,'Sarah','sarah@fitpt.com','" . $hashedDefaultTestingPassword . "','t'),
            (default,'Sasha','sasha@fitpt.com','" . $hashedDefaultTestingPassword . "','t'),
            (default,'Wilbur','wilbur@fitpt.com','" . $hashedDefaultTestingPassword . "','t'),
            (default,'Administrator','admin@fitpt.com','" . $hashedDefaultTestingPassword . "','a'),
            (default,'Scheduler','scheduler@fitpt.com','" . $hashedDefaultTestingPassword . "','s');";

        // executing system users queries
        if (mysqli_query($connection, $createSystemUsersTableQuery)) {
            //echo "<br>Table 'appointments' created successfully";

            // MAYBE SHOULD only populate once? still testing
            mysqli_query($connection, $populateSystemUsersTableQuery);
        } else {
            //echo "<br>Error creating table 'appointments': " . mysqli_error($connection);
        }

        // Create the "appointments" table query
        $createAppointmentsTableQuery = "create table if not exists appointments
        (
            appt_id int primary key auto_increment,
            patient_name varchar(60) not null,
            patient_phone varchar(15) not null,
            patient_email varchar(60) not null,
            intake_notes varchar(250) not null,
            start_time int not null,
            therapist_id int not null,
            type_of_therapy varchar(15) not null,
            appointment_date date not null,
            -- foreign key won't work unless system_users is already created
            foreign key (therapist_id) references system_users(user_id)
        );";

        // executing create appointments table query
        if (mysqli_query($connection, $createAppointmentsTableQuery)) {
            //echo "<br>Table 'appointments' created successfully";
        } else {
            //echo "<br>Error creating table 'appointments': " . mysqli_error($connection);
        }

        // creating cert table query
        $createCertificationsTableQuery = "create table if not exists certifications
        (
            name_short varchar(15) unique not null,
            name_long varchar(75) not null,
            type_of_therapy varchar(30) not null
        );";

        // query to populate cert table - only once
        $populateCertificationsTableQuery = "insert into certifications
        values
            ('AET','Advanced Exercise Therapist','Exercise Therapy'),
            ('CAPP-OB','Certificate of Achievement in Pregnancy and Postpartum Physical Therapy','Pregnancy/Postpartum Therapy'),
            ('CAPP-Pelvic','Certificate of Achievement in Pelvic Physical Therapy','Pelvic Therapy'),
            ('CHT','Certified Hand Therapist','Hand Therapy'),
            ('CKTP','Certified Kinesio Taping Practitioner','Taping Therapy'),
            ('CLT','Certified Lymphedema Therapist','Lymphedema Therapy'),
            ('CREX','Certification in Rehabilitative Exercise','Rehabilitative Therapy'),
            ('CSCS' ,'Certified Strength and Conditioning Specialist','Conditioning Therapy'),
            ('CYT' ,'Certified Yoga Therapist','Yoga Therapy'),
            ('GCS' ,'Geriatric Certified Specialist','Geriatic Therapy'),
            ('LMT' ,'Licensed Massage Therapist','Massage Therapy'),
            ('OCS' ,'Orthopedic Certified Specialist','Orthopedic Therapy'),
            ('PAS' ,'Postural Alignment Specialist','Alignment Therapy'),
            ('PCS' ,'Pediatric Certified Specialist','Pediatric Therapy'),
            ('SCS' ,'Sports Certified Specialist','Sports Therapy'),
            ('WCS' ,'Women\’s Certified Specialist','Women\'s Therapy')
        ;";

        // executing cert table queries
        if (mysqli_query($connection, $createCertificationsTableQuery)) {
            //echo "<br>Table 'appointments' created successfully";
            mysqli_query($connection, $populateCertificationsTableQuery);
        } else {
            //echo "<br>Error creating table 'appointments': " . mysqli_error($connection);
        }

        // create therapist cert relationship table query
        $createTherapistCertificationRelationTableQuery = "create table therapist_certification_relation 
        (
          therapist_id int not null,
          cert_name varchar(15) not null,
          foreign key (therapist_id) references system_users(user_id),
          foreign key (cert_name) references certifications(name_short),
          unique (therapist_id, cert_name)
        );";

        // query to populate therapist cert relationship table - only once
        $populateTherapistCertificationRelationTableQuery = "insert into therapist_certification_relation values
        (1,'CLT'), (1,'LMT'),
        (2,'AET'), (2,'CHT'),(2,'CREX'),(2,'CSCS'),(2,'CYT'),(2,'LMT'),(2,'OCS'),(2,'SCS'),(2,'WCS'),
        (3,'CAPP-OB'),(3,'CKTP'),(3,'WCS'),
        (4,'CAPP-Pelvic'),(4,'CHT'),(4,'CKTP'),
        (5,'CAPP-OB'),(5,'GCS'),
        (6,'AET'),
        (7,'AET'),(7,'CHT'),(7,'CREX'),(7,'CSCS'),(7,'CYT'),(7,'LMT'),(7,'SCS'),
        (8,'CAPP-OB'),(8,'PAS'),(8,'WCS'),
        (9,'CKTP'),(9,'CLT'),(9,'LMT'),
        (10,'CYT'),(10,'PCS'),(10,'WCS'),
        (11,'CREX'),(11,'CSCS'),
        (12,'PCS'),
        (13,'CSCS'),(13,'SCS'),
        (14,'CYT'),
        (15,'AET'),(15,'CKTP'),(15,'SCS'),
        (16,'CHT'),(16,'OCS'),
        (17,'GCS'),
        (18,'CAPP-OB'),(18,'CAPP-Pelvic'),(18,'CYT'),(18,'LMT'),(18,'WCS'),
        (19,'AET'),(19,'CKTP'),(19,'CSCS'),(19,'SCS'),
        (20,'CAPP-Pelvic'),(20,'CLT'),(20,'CREX'),(20,'CSCS'),(20,'GCS'),(20,'PAS'),(20,'WCS'),
        (21,'CAPP-OB'),(21,'CAPP-Pelvic'),(21,'WCS');";

        // executing therapist cert relationship table queries
        if (mysqli_query($connection, $createTherapistCertificationRelationTableQuery)) {
            //echo "<br>Table 'appointments' created successfully";
            mysqli_query($connection, $populateTherapistCertificationRelationTableQuery);
        } else {
            //echo "<br>Error creating table 'appointments': " . mysqli_error($connection);
        }
    } else {
        //echo "Error creating database: " . mysqli_error($connection);
    }
} else {
    //echo "Database already exists, no action taken.";
} ?>