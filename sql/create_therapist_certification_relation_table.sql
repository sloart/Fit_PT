Use Fit_PT;

create table therapist_certification_relation 
  (
    therapist_id int not null,
    cert_name varchar(15) not null,
    foreign key (therapist_id) references system_users(user_id),
    foreign key (cert_name) references certifications(name_short),
    unique (therapist_id, cert_name)
  );

insert into therapist_certification_relation values
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
(21,'CAPP-OB'),(21,'CAPP-Pelvic'),(21,'WCS');

-- it might be better later to use this view instead of manipulating the table directly:
create view therapist_cert (therapist,cert) as select therapist_id,cert_name from therapist_certification_relation;
