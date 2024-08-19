# Syntax

<> = Wajib;
[] = Opsional;

## Table
### Create
```sql
create table <nama table> (
    <nama kolom> <tipe data> [not null] [auto increment] [unique] [default <nilai>] [primary key]
);
```

### Alter
- Manambah primary key
```sql
alter table <nama table> add primary key (<nama kolom>);
```

- Menambah kolom baru

```sql
alter table <nama table> add <nama kolom> <tipe data> [not null] [auto_increment] [unique] [default <nilai>] [primary key];
```

- Mengubah kolom
```sql
alter table <nama table> modify <nama kolom> <tipe data> [not null] [auto_increment] [unique] [default <nilai>] [primary key];
```

- Menghapus kolom
```sql
alter table <name table> drop column <nama kolom>
```
