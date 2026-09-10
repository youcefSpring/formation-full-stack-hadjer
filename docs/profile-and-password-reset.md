# Profile edit & password reset by Gmail

## 1. Profile (authenticated user)

Page: `/admin/profile` — `resources/views/admin/profile/edit.blade.php`.

| Method | URI | Name | Action |
|--------|-----|------|--------|
| GET | `/admin/profile` | `admin.profile.edit` | show form |
| PUT | `/admin/profile` | `admin.profile.update` | update name + email |
| PUT | `/admin/profile/password` | `admin.profile.password` | change password |

Rules:

* name: `required|string|max:255`
* email: `required|email|unique:users,email` (current user ignored)
* password change: `current_password` must match the stored hash,
  new `password` is `confirmed` and at least 8 characters.

The `password` attribute is cast to `hashed` on `App\Models\User`, so plain
values are hashed automatically on save.

## 2. Password reset by email

Uses Laravel's built-in `Password` broker and the `password_reset_tokens`
table (already in `0001_01_01_000000_create_users_table.php`).

Controller: `App\Http\Controllers\PasswordResetController`.

| Method | URI | Name | Action |
|--------|-----|------|--------|
| GET | `/forgot-password` | `password.request` | ask for the email |
| POST | `/forgot-password` | `password.email` | send the reset link |
| GET | `/reset-password/{token}` | `password.reset` | new-password form |
| POST | `/reset-password` | `password.update` | store the new password |

Views: `resources/views/auth/forgot-password.blade.php` and
`resources/views/auth/reset-password.blade.php`. The login page links to
`password.request`, and the profile page links there too.

Flow: email submitted → `Password::sendResetLink()` → Laravel emails the
`ResetPassword` notification containing `route('password.reset', $token)` →
user sets a new password → token deleted → redirect to login with a flash
message.

## 3. Gmail SMTP configuration

Gmail refuses plain account passwords. You need an **App Password**:

1. Enable 2-Step Verification on the Google account.
2. Go to <https://myaccount.google.com/apppasswords>.
3. Create an app password ("Mail" / "Other") and copy the 16 characters.

Then in `.env`:

```dotenv
MAIL_MAILER=smtp
MAIL_SCHEME=null
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-gmail-address@gmail.com
MAIL_PASSWORD="the-16-char-app-password"
MAIL_FROM_ADDRESS="your-gmail-address@gmail.com"
MAIL_FROM_NAME="${APP_NAME}"
```

Notes:

* Port 587 uses STARTTLS; leave `MAIL_SCHEME=null`. For SSL use port 465 and
  `MAIL_SCHEME=smtps`.
* Never commit the real app password — `.env` stays out of git, `.env.example`
  holds placeholders only.
* Run `php artisan config:clear` after editing `.env`.
* Test locally with `MAIL_MAILER=log` and read `storage/logs/laravel.log`,
  or send a test:

```bash
php artisan tinker
>>> Mail::raw('test', fn ($m) => $m->to('you@example.com')->subject('test'));
```

Common failures: `535 Username and Password not accepted` → app password
wrong or 2FA off; connection timeout on 587 → outbound SMTP blocked by the
network/host.
