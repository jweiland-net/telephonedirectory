#
# Table structure for table 'tx_telephonedirectory_domain_model_employee'
#
CREATE TABLE tx_telephonedirectory_domain_model_employee (
	title TINYINT(1) DEFAULT '0' NOT NULL,
	path_segment varchar(2048) DEFAULT '' NOT NULL,
	first_name varchar(255) DEFAULT '' NOT NULL,
	last_name varchar(255) DEFAULT '' NOT NULL,
	name_additions varchar(255) DEFAULT '' NOT NULL,
	is_catch_all_mail TINYINT(1) DEFAULT '0' NOT NULL,
	function varchar(255) DEFAULT '' NOT NULL,
	office int(11) unsigned DEFAULT '0',
	company varchar(255) DEFAULT '' NOT NULL,
	department int(11) unsigned DEFAULT '0' NOT NULL,
	building int(11) unsigned DEFAULT '0' NOT NULL,
	subject_field int(11) unsigned DEFAULT '0' NOT NULL,
	room_number varchar(255) DEFAULT '' NOT NULL,
	telephone1 varchar(255) DEFAULT '' NOT NULL,
	telephone2 varchar(255) DEFAULT '' NOT NULL,
	telephone3 varchar(255) DEFAULT '' NOT NULL,
	mobile varchar(255) DEFAULT '' NOT NULL,
	email varchar(255) DEFAULT '' NOT NULL,
	pager varchar(255) DEFAULT '' NOT NULL,
	fax varchar(255) DEFAULT '' NOT NULL,
	image int(11) unsigned DEFAULT '0' NOT NULL,
	regular_attendance text DEFAULT '' NOT NULL,
	language_skill int(11) unsigned DEFAULT '0' NOT NULL,
	pc_fax varchar(255) DEFAULT '' NOT NULL,
	additional_informations text DEFAULT '' NOT NULL,
	module_sys_dmail_html tinyint(4) unsigned DEFAULT '1' NOT NULL
);

#
# Table structure for table 'tx_telephonedirectory_domain_model_office'
#
CREATE TABLE tx_telephonedirectory_domain_model_office (
	title varchar(255) DEFAULT '' NOT NULL,
	code varchar(30) DEFAULT '' NOT NULL,
	token varchar(30) DEFAULT '' NOT NULL,
	departments int(11) unsigned DEFAULT '0',
	subject_fields int(11) unsigned DEFAULT '0' NOT NULL
);

#
# Table structure for table 'tx_telephonedirectory_domain_model_subjectfield'
#
CREATE TABLE tx_telephonedirectory_domain_model_subjectfield (
	title varchar(255) DEFAULT '' NOT NULL
);

#
# Table structure for table 'tx_telephonedirectory_domain_model_building'
#
CREATE TABLE tx_telephonedirectory_domain_model_building (
	title varchar(255) DEFAULT '' NOT NULL,
	street varchar(64) DEFAULT '' NOT NULL,
	house_number varchar(32) DEFAULT '' NOT NULL,
	zip varchar(16) DEFAULT '' NOT NULL,
	city varchar(32) DEFAULT '' NOT NULL
);

#
# Table structure for table 'tx_telephonedirectory_domain_model_department'
#
CREATE TABLE tx_telephonedirectory_domain_model_department (
	title varchar(255) DEFAULT '' NOT NULL
);

#
# Table structure for table 'tx_telephonedirectory_domain_model_languageskill'
#
CREATE TABLE tx_telephonedirectory_domain_model_languageskill (
	employee int(11) unsigned DEFAULT '0' NOT NULL,
	language int(11) unsigned DEFAULT '0' NOT NULL,
	writing varchar(32) DEFAULT '' NOT NULL,
	speaking varchar(32) DEFAULT '' NOT NULL,
	infotext text NOT NULL
);

#
# Table structure for table 'tx_telephonedirectory_domain_model_language'
#
CREATE TABLE tx_telephonedirectory_domain_model_language (
	title varchar(255) DEFAULT '' NOT NULL
);

#
# Table structure for table 'tx_telephonedirectory_office_mm'
#
CREATE TABLE tx_telephonedirectory_office_mm
(
	uid_local int(11) DEFAULT '0' NOT NULL,
	uid_foreign int(11) DEFAULT '0' NOT NULL,
	tablenames varchar(255) DEFAULT '' NOT NULL,
	fieldname varchar(255) DEFAULT '' NOT NULL,
	sorting int(11) DEFAULT '0' NOT NULL,
	sorting_foreign int(11) DEFAULT '0' NOT NULL,

	KEY uid_local_foreign (uid_local,uid_foreign),
	KEY uid_foreign_tablefield (uid_foreign,tablenames(40),fieldname(3),sorting_foreign)
);
