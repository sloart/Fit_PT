use Fit_PT;

create table if not exists appointments
    (
    	appt_id int primary key auto_increment,
    	patient_name varchar(60) not null,
    	patient_phone varchar(15) not null,
    	patient_email varchar(60) not null,
    	intake_notes varchar(250) not null,
    	start_time int not null,
    	therapist_id int not null,
		type_of_therapy varchar(15) not null,
		appointment_date date not null
    );

-- add foreign key
alter table appointments
add foreign key (therapist_id) references system_users(user_id);

-- fill some records in for testing (MAY NOT WORK WITH NEW FIELDS)
 insert into appointments values
(default,'Stephanie Ondo','843-343-7287','slo.art@protonmail.com','Got hit by car, landed on big toe, hyperextended said toe.',default,default),
(default,'Matthew Ondo','843-277-5812','mattondo@hotmail.com','keeper in soccer game. pulled groin per regular doctor.',default,default),
(default,'Jorden McLean','843-555-5555','jojo@jojo.com','knocked their knee on a knoll, now the knee won\'t bend',2,default),
(default,'Fiora McLean','843-333-3333','fiora@fiora.com','insanely stuffy nose causing mouth breathing and inability to walk in a straight line',12,4),
(default,'Hershey Chom Chom','843-123-4567','chonker@chonky.com','former athlete gone to seed. Wants to regain some semblance of gracefulness with his functional movements. Lands like a rock whenever he jumps off the couch.',default,default),
(default,'Giovanni BabyCat','843-666-6666','gio@gio.com','Competitive Parkour athlete looking for a rigorous training schedule to be the best she can be',1,5);
