drop database PET_GURU;
create database PET_GURU;
use PET_GURU;

create table brands (
	brand_id int auto_increment primary key,
	brand_name varchar(200) null,
	deleted bit null,
	updated_date datetime null,
)
go

create table products (
	product_id int auto_increment primary key,
	product_name varchar(200) null,
	brand_id int not null foreign key references brands(brand_id),
	deleted bit null,
	updated_date datetime null,
)
go

create table categories (
	category_id int auto_increment primary key,
	category_name varchar(200) null,
	deleted bit null,
	updated_date datetime null,
)
go

create table question_types (
	question_type_id int auto_increment primary key,
	question_type varchar(200) null
)
go


create table questions (
	question_id int auto_increment primary key,
	question_name varchar(200) null,
	question_type_id int not null foreign key references question_types(question_type_id),
	category_id int not null foreign key references categories(category_id),
	deleted bit null,
	updated_date datetime null,
)
go



create table attributes (
	attribute_id int auto_increment primary key,
	attribute varchar(200) null,
	weightage int not null,
	deleted bit null,
	updated_date datetime null,
)
go


create table question_attributes (
	question_attribute_id int auto_increment primary key,
	question_id int not null foreign key references questions(question_id),	
	attribute_id int not null foreign key references attributes(attribute_id),	
	deleted bit null,
	updated_date datetime null,
)
go





create table attribute_products (
	attribute_product_id int auto_increment primary key,
	attribute_id int not null foreign key references attributes(attribute_id),
	product_id int not null foreign key references products(product_id),	
	deleted bit null,
	updated_date datetime null,
)
go











