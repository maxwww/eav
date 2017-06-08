-- auto-generated definition
create table categories
(
	id int(10) unsigned not null auto_increment
		primary key,
	name varchar(191) not null,
	description text null,
	attributes text not null,
	created_at timestamp null,
	updated_at timestamp null
)
;

