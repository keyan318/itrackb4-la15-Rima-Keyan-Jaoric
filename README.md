# Part F · README

### 1. What questions did my project answer last week and this week?

Last week, my project answered **“Who are you?”** through authentication, which identifies whether someone is logged in; this week, it answers **“What are you allowed to do?”** through authorization. My `MoviePolicy.php` answers the second question by checking user roles, while `routes/web.php` and its authentication routes and middleware handle the first question.

### 2. Why is `role` not in `$fillable`, but I can still set it in Tinker?

I excluded the `role` column from `$fillable` in my `User.php` model to prevent users from changing their own roles through mass assignment. I was still able to assign `$u->role = 'admin'` and save it in Tinker because direct property assignment does not use the `$fillable` protection. This protects sensitive fields such as `role` from being accidentally or maliciously changed through mass-assigned request data.

### 3. Why does a non-admin get a 403 while a guest gets redirected to login?

When a signed-in non-admin visits `/movies/create`, my `MoviePolicy.php` denies the action through `Gate::authorize()`, which produces a 403 Forbidden response. When a guest visits the same route, the `auth` middleware in `routes/web.php` redirects them to the login page because they have not authenticated yet.

### 4. Why are my list and detail pages open to everyone?

I intentionally allowed everyone to access `/movies` and `/movies/{movie}` because visitors and regular users should be able to browse movie information without needing administrator privileges. My `MoviePolicy.php` reflects this decision because `viewAny()` and `view()` return `true`, while creating, updating, and deleting movies require the administrator role.

### 5. Why did I put the role check in a policy instead of writing it twice?

I placed the administrator role check in `MoviePolicy.php` so my `MovieController.php` and `movies/index.blade.php` can use the same authorization rules. If I manually wrote the role check in both places, I could accidentally make them inconsistent, causing the interface to show an action that the controller would reject or allowing the rules to become difficult to maintain.

### 6. What does `SESSION_LIFETIME` count, and why was there no warning?

In my project, `SESSION_LIFETIME` specifies how many minutes a session may remain inactive before it expires; it does not measure the total time I spend logged in or the time a browser tab stays open. I received no warning because Laravel does not automatically display an expiration notification when the session expires, so I only discovered it after clicking a protected link and being redirected to the login page.