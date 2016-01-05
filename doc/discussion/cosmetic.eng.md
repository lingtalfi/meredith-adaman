List: How do I handle foreign keys for displaying?
------------------------------------------------------------
2016-01-05


The problem, you have a two tables: users and pets, and a pet belongs to one user.
When you display the pets table, the users_id column shows ugly numbers, but you want to customize 
the column (for instance you want the users_id column content to be something like "1. Michelle" instead of just "1").



The solution is to change your sql request.

Instead of:

```sql
select id, users_id, the_name from pets
```

do:

```sql
select p.id, concat( p.users_id, ". ", u.the_name ) as users_id, p.the_name from pets p inner join users u on u.id=p.users_id
```


Since this is a common situation, Meredith has a workflow for that.
The portion of the sql request that corresponds to a field that you want to enhance visually is called a
cosmetic field.

For instance, in our previous request, there is one cosmetic field which is: 

```sql
concat( p.users_id, ". ", u.the_name ) as users_id
```

It's important that the cosmetic field is aliased to the original name (users_id).
One thing to note here is that a cosmetic field will use table aliases, here "p" and "u".
"p" is called the main alias (or primary alias), since it references the table in the from clause of 
our original request.

When we do a cosmetic change, we need two other things: 
 
- update the from clause ("from pets" become "from pets p inner join users u on u.id=p.users_id")
- define which is the main alias (in this case "p" is the main alias, we don't care of "u", as far as automation is concerned) 

So this strategy is enough to allow cosmetic changes, while keeping basic automated crud functionality.
