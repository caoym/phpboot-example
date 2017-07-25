CREATE TABLE books
(
    id INTEGER PRIMARY KEY,
    name TEXT NOT NULL,
    brief TEXT,
    pictures TEXT
    UNIQUE (id),
);