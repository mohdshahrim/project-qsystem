# How Database is Designed and Managed

### Principle

1. All table (except user at coredb) will have the first row as dummy data.

2. No Foreign Key. All reference from another table will use row id, but when conflict happen, the row id will be set to 1 to prevent orphaned table.

3. No hard delete. All table must use soft delete.