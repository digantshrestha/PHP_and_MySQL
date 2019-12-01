create database pizzaDB;
use pizzaDB;

create table pizzas(
    id int primary key auto_increment not null,
    title varchar(255) not null,
    ingredients varchar(255) not null,
    email varchar(255) not null,
    created_at timestamp default current_timestamp
);

