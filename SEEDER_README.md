# 📊 Database Seeders - Production-Like Data

Comprehensive database seeders with realistic forum data for CodeHub application.

## ✅ What's Included

| Seeder | Records | Description |
|--------|---------|-------------|
| CategorySeeder | 11 | Forum categories (Asking, Tutorial, Tips & Trick, etc) |
| TagSeeder | 28 | Tech tags (php, javascript, react, laravel, etc) |
| UserSeeder | 15 | 2 admins + 13 regular users |
| ThreadSeeder | 14 | Discussion threads with real technical content |
| ReplySeeder | 25 | Helpful replies with code examples |
| ThreadRelationSeeder | - | thread_categories & thread_tags pivot tables |
| LikeSeeder | 95 | Likes on threads and replies |
| NotificationSeeder | 24 | User notifications (read/unread) |

**Total:** 258+ realistic records

---

## 🚀 Quick Start

### Option 1: Full Reset (Recommended for Development)

```bash
# 1. Rollback migrations
php spark migrate:rollback

# 2. Run migrations
php spark migrate

# 3. Run seeders
php spark db:seed Run
```

### Option 2: Fresh Database

```bash
# Drop and recreate database
mysql -u root -e "DROP DATABASE IF EXISTS codehub; CREATE DATABASE codehub CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;"

# Run migrations
php spark migrate

# Run seeders
php spark db:seed Run
```

---

## ⚠️ Known Issue: UserSeeder

Due to Tatter\Relations compatibility with CI 4.7, UserSeeder may encounter `insertBatch` signature mismatch.

### Workaround

If UserSeeder fails, seed users manually:

```bash
# Seed categories and tags first
php spark db:seed CategorySeeder
php spark db:seed TagSeeder

# Manual SQL for users (run in MySQL)
mysql -u root codehub < app/Database/Seeds/users_manual.sql

# Continue with other seeders
php spark db:seed ThreadSeeder
php spark db:seed ReplySeeder
php spark db:seed ThreadRelationSeeder
php spark db:seed LikeSeeder
php spark db:seed NotificationSeeder
```

---

## 👥 Login Credentials

### Admin Accounts

| Name | Username | Email | Password |
|------|----------|-------|----------|
| Budi Santoso | `budisan` | budi.santoso@codehub.test | `password123` |
| Siti Rahayu | `sitirah` | siti.rahayu@codehub.test | `password123` |

### Regular Users

All 13 regular users use password: `password123`

Sample users:
- `ahmadf` - ahmad.fauzan@example.test
- `dindap` - dinda.pratiwi@example.test
- `rizkyr` - rizky.ramadhan@example.test
- (See full list in UserSeeder.php)

---

## 📊 Data Overview

### Threads (14 total)

**Popular threads:**
- "Cara Mengoptimalkan Query Database di Laravel" (1,247 views, 8 likes)
- "Error CORS saat Hit API" (2,156 views, 12 likes, SOLVED)
- "Tutorial JWT di CodeIgniter 4" (3,421 views, 10 likes)
- "Git Merge Conflict Tips" (2,341 views, 7 likes)

**Recent threads:**
- Flutter vs React Native (12 hours ago)
- CI/CD dengan GitHub Actions (6 hours ago)

**Topics covered:**
- Laravel optimization
- React state management
- Flutter/React Native comparison
- Git workflows
- Python NLP
- UI/UX tools
- Database choices
- Security (CORS, rate limiting)

### Replies (25 total)

All replies contain:
- Real code snippets with syntax highlighting
- Technical explanations
- Best practices
- Follow-up discussions
- Nested replies (parent-child relationships)

### Engagement

- **Views:** 478 - 3,421 (realistic distribution)
- **Likes:** 4-12 per popular thread
- **Solved threads:** CORS error thread marked solved with accepted answer
- **Draft:** 1 thread in draft status

---

## 🎯 Testing Scenarios

Use this seeded data to test:

✅ **Homepage**
- Thread list with views, likes
- Recent activity
- Popular threads sorting

✅ **Thread Detail**
- Full discussion view
- Reply threading (nested comments)
- Like functionality
- View counter

✅ **User Profile**
- User info with social links
- Thread contributions
- Reply history

✅ **Categories & Tags**
- Filter threads by category
- Browse by tags
- Tag cloud

✅ **Search**
- Search threads by title/content
- Filter by tags/categories

✅ **Notifications**
- Unread notification badge
- Reply notifications
- Like notifications

✅ **Admin Dashboard**
- User management
- Content moderation
- View statistics

✅ **Pagination**
- Thread pagination (14 threads)
- Reply pagination

---

## 📈 Database Statistics

Verify seeded data:

```bash
# Check all table counts
php spark db:seed Run && mysql -u root -e "
SELECT 
  (SELECT COUNT(*) FROM codehub.users) as users,
  (SELECT COUNT(*) FROM codehub.categories) as categories,
  (SELECT COUNT(*) FROM codehub.tags) as tags,
  (SELECT COUNT(*) FROM codehub.threads) as threads,
  (SELECT COUNT(*) FROM codehub.replies) as replies,
  (SELECT COUNT(*) FROM codehub.likes) as likes,
  (SELECT COUNT(*) FROM codehub.notifications) as notifications;
"
```

Expected output:
```
users: 15
categories: 11
tags: 28
threads: 14
replies: 25
likes: 95
notifications: 24
```

---

## ✨ Data Quality Features

### ✅ NO Placeholder/Dummy Patterns

- ❌ No "Demo User", "Test Admin", "Sample Thread"
- ❌ No generic IDs like "DEMO-001", "TEST-USER"
- ✅ Real Indonesian names (Ahmad Fauzan, Dinda Pratiwi, etc)
- ✅ Professional email domains (@codehub.test, @example.test)
- ✅ Realistic social media links

### ✅ Natural Forum Content

- Real technical discussions developers have
- Code examples in PHP, JavaScript, Python, Flutter
- Solved problems with accepted answers
- Tutorial-style threads with step-by-step guides
- Varied engagement patterns (viral threads vs niche questions)

### ✅ Data Integrity

- All foreign keys valid
- No orphan records
- Unique constraints respected
- Enum values correct (published/draft, admin/user)
- Timestamps staggered naturally (15 days of activity)

### ✅ Security

- Passwords bcrypt hashed
- Safe test domains (no real emails)
- No production credentials

---

## 🔄 Resetting Data

### Clear Specific Tables

```bash
# Warning: This will delete data!
mysql -u root codehub -e "
SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE notifications;
TRUNCATE TABLE likes;
TRUNCATE TABLE thread_tags;
TRUNCATE TABLE thread_categories;
TRUNCATE TABLE replies;
TRUNCATE TABLE threads;
TRUNCATE TABLE users;
TRUNCATE TABLE tags;
TRUNCATE TABLE categories;
SET FOREIGN_KEY_CHECKS = 1;
"

# Re-run seeders
php spark db:seed Run
```

### Full Database Reset

```bash
# Nuclear option: drop and recreate
php spark migrate:rollback
php spark migrate
php spark db:seed Run
```

---

## 📝 Extending Seeders

### Add More Users

Edit `app/Database/Seeds/UserSeeder.php` and add to `$users` array:

```php
[
    'first_name' => 'Nama',
    'last_name'  => 'Lengkap',
    'username'   => 'username',
    'email'      => 'email@example.test',
    'password'   => password_hash('password123', PASSWORD_BCRYPT),
    'role'       => 'user',
    'avatar'     => 'avatar.png',
    'banner'     => 'banner.png',
],
```

### Add More Threads

Edit `app/Database/Seeds/ThreadSeeder.php` and add to `$threads` array.

Remember to:
- Use realistic titles and content
- Set appropriate `user_id` (1-15)
- Add corresponding entries in ThreadRelationSeeder
- Vary `created_at` timestamps

---

## 🐛 Troubleshooting

### "Duplicate entry" Error

Tables already have data. Use one of:
- `php spark migrate:rollback` then migrate again
- Truncate tables manually (see "Resetting Data")

### "Table doesn't exist" Error

Migrations not run. Execute:
```bash
php spark migrate
```

### "Column count doesn't match" Error

This is the Tatter\Relations issue with UserSeeder. Use manual SQL workaround (see above).

### Foreign Key Constraint Error

Seeding order matters. Always use `Run.php` which seeds in correct order:
1. Categories & Tags (no dependencies)
2. Users (no dependencies)
3. Threads (depends on users)
4. Replies (depends on threads & users)
5. Relations (depends on threads, tags, categories)
6. Likes & Notifications (depends on threads/replies/users)

---

## 📚 Related Files

- **Seeders:** `app/Database/Seeds/`
- **Migrations:** `app/Database/Migrations/`
- **Models:** `app/Models/`
- **Database Config:** `app/Config/Database.php`

---

**Enjoy realistic, production-like test data! 🎉**

For questions or issues, check the seeder files directly - they're well-documented with inline comments.
