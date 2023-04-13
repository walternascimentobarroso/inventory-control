CREATE TABLE public.categories (
	id serial PRIMARY KEY,
	description varchar NULL
);

CREATE TABLE public.products (
	id serial PRIMARY KEY,
	description varchar NULL,
	category int4 NULL,
	barcode varchar NULL,
	value varchar NULL,
	tax varchar NULL
);

CREATE TABLE public.sales (
	id serial PRIMARY KEY,
	items varchar(255) NULL,
	total int4 NULL
);

CREATE TABLE public.users (
	id serial PRIMARY KEY,
	name varchar(255) NULL,
	email varchar(255) NULL
);
