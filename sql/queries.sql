-- list all therapists with a given certification (SCHEDULER and ADMIN):
-- select user_id from system_users where locate('LMT',user_certs) > 0;

-- list all therapists with a given certification (utilizes the bridging table):
select therapist_id from therapist_certification_relation where cert_name = 'LMT';


-- return number of therapists:
select count(*) from system_users where user_type = 't';


-- return number of therapists with a given certification (utilizes the bridging table):
select count(*) from therapist_certification_relation where cert_name = 'LMT';

-- return number of certifications that a given therapist has (utilizes the bridging table):
select count(*) from therapist_certification_relation where therapist_id = 3;



-- return the names of a therapist and patient who share an appointment
select user_name as therapist, patient_name from system_users join appointments on user_id = therapist_id;

-- return all apointments for a given therapist
select * from appointments where therapist_id = 3;

-- return an appointment with no start time set yet
select appt_id from appointments where start_time is null;

-- return an appointment with no therapist set yet
select appt_id from appointments where therapist_id is null;

/*
create/edit user (ADMIN ONLY)
*/
-- single query that creates an entire record (here as user_type 't'):
insert into system_users values (default,'name','email@fit.pt','t','');

-- add/edit user name (ADMIN)
update system_users set user_name = 'Updated [Name]' where user_id = 1;

-- add/edit user email (ADMIN)
update system_users set user_email = 'updatedemail@email.com' where user_id = 1;

-- add/edit user type (ADMIN) probably wouldn't be used much IRL
update system_users set user_type = 's' where user_id = 1;


-- add a therapist's certification (ADMIN)
insert into therapist_certification_relation values (11,'ABC');
-- same query using the therapist_certs view instead:
 insert into therapist_certs values (11,'ABC');	

-- delete a therapist's certification (ADMIN)
delete from therapist_certification_relation where therapist_id = 11 and cert_name = 'ABC';
-- same query using the therapist_certs view instead:
delete from therapist_certs where therapist = 11 and certs = 'ABC';

-- delete user (ADMIN)
delete from system_users where user_id = 11;


/*
create/edit appt (SCHEDULER and ADMIN)
here is a single query that creates an entire record
with a unique appt_id, and with null values for start_time, start_date, and therapist_id
*/
insert into appointments values (default,'Patient Nombre','8433437287','another@email.com','Some notes and notes and notes.',default,default,default);

-- enter intake notes
update appointments set intake_notes = 'Up to 250 chars of stuff here.' where appt_id = 1;

-- enter pt name
update appointments set patient_name = 'Patient Name' where appt_id = 1;

-- enter pt email
update appointments set patient_email = 'ptemail@email.com' where appt_id = 1;

-- enter pt phone
update appointments set patient_phone = 'upto15charshere' where appt_id = 1;
