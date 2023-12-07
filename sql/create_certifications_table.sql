use Fit_PT;

create table if not exists certifications
	(
		name_short varchar(15) unique not null,
		name_long varchar(75) not null,
		type_of_therapy varchar(30) not null
	);

insert into certifications
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
	;
