CREATE TABLE public.categories (
	id serial4 NOT NULL,
	description varchar NULL,
	CONSTRAINT categories_pkey PRIMARY KEY (id)
);

CREATE TABLE public.products (
	id serial4 NOT NULL,
	description varchar NULL,
	category int4 NULL,
	barcode varchar NULL,
	value varchar NULL,
	tax varchar NULL,
	CONSTRAINT products_pkey PRIMARY KEY (id)
);

CREATE TABLE public.sales (
	id serial4 NOT NULL,
	items varchar(255) NULL,
	total int4 NULL,
	CONSTRAINT sales_pkey PRIMARY KEY (id)
);

CREATE TABLE public.users (
	id serial4 NOT NULL,
	name varchar(255) NULL,
	email varchar(255) NULL,
	CONSTRAINT users_pkey PRIMARY KEY (id)
);
