CREATE TABLE "barang" (
	"id"	INTEGER NOT NULL,
	"nama"	TEXT NOT NULL,
	"stok"	INTEGER DEFAULT 0,
	"harga"	INTEGER DEFAULT 0,
	PRIMARY KEY("id")
);