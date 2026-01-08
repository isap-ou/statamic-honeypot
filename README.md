# Honeypot Spam Protection

> ⚠️ **Important — Commercial addon**  
> This addon is paid software. You may use it for free during development, but you must purchase a valid license from the [Statamic Marketplace](https://statamic.com/marketplace) before deploying it to a production environment.

## Introduction

**Honeypot Spam Protection** is a commercial Statamic addon that provides a native Statamic integration layer for the open-source package [`spatie/laravel-honeypot`](https://github.com/spatie/laravel-honeypot).

This addon does **not** replace or modify Spatie’s package. It connects Statamic’s form system to the existing honeypot and time-based spam protection logic provided by Spatie and exposes it in a way that fits naturally into Statamic projects.

---

## ⚠️ Known issue in Statamic ≤ 5.70

Statamic versions **up to and including 5.70** contain a bug that prevents the honeypot JavaScript driver from working correctly with Alpine-powered forms.

If you need a working Alpine.js integration, apply the upstream Statamic patch from PR **#13463**.

Patch URL:

```
https://patch-diff.githubusercontent.com/raw/statamic/cms/pull/13463.patch
```

After applying the patch, use `js="honeypot"` on your Statamic form as documented below.

---

## What this addon does

This addon makes it possible to use `spatie/laravel-honeypot` inside Statamic without having to wire it up manually in Laravel.

It provides:

- A Statamic-native way to enable honeypot protection for forms
- Automatic integration with Statamic form submissions
- Access to all configuration options provided by `spatie/laravel-honeypot`

The spam detection logic itself is **entirely provided by Spatie’s package**.  
This addon is responsible only for the Statamic integration layer.

---

## How it works (high level)

Internally, this addon installs and uses the Composer package:

```
spatie/laravel-honeypot
```

Spatie’s package provides:
- Hidden honeypot fields
- Time-based submission protection
- Request validation and spam detection

This Statamic addon:
- Loads the Spatie package
- Connects it to Statamic’s form handling pipeline
- Applies the honeypot checks when Statamic forms are submitted
- Registers Spatie's honeypot middleware in the application's web middleware group by default

No changes are made to Spatie’s code, and no part of their package is forked or modified.

---

## Installation

Install the addon via Composer:

```
composer require isapp/statamic-honeypot
```

After installation, the Spatie Honeypot package will be available to your Statamic application through this addon.

---

## Configuration

This addon uses the standard configuration file provided by `spatie/laravel-honeypot`.

All enable/disable behavior is controlled by Spatie's configuration. When honeypot protection is enabled in Spatie's config, the Spatie honeypot middleware is active. When it is disabled, no honeypot checks are performed. This addon does not introduce a separate on/off switch.

All configuration options (field names, time limits, enabled/disabled state, etc.) are defined and documented by Spatie and remain unchanged.

You can publish and adjust the configuration file as you would when using `spatie/laravel-honeypot` directly in Laravel.

---

## Using it in Statamic

This addon integrates the Spatie honeypot system into Statamic’s form system.

You do **not** need to use Statamic’s built-in honeypot or spam protection features.  
This addon provides its own integration layer based on Spatie’s package.

### Antlers

To enable honeypot protection on a Statamic form, include the tag inside your form:

```antlers
{{ isapp:honeypot }}
```

There is **no automatic injection**. You must add the tag to each form you want to protect.

#### Alpine.js

If you are using Statamic's Alpine-driven form features (via Statamic's `js` form driver), follow the same approach as in the Statamic documentation, but use `js="honeypot"` instead of `js="alpine"` on your form tag.

Example:

```antlers
{{ form:contact js="honeypot" }}
    {{ isapp:honeypot }}
{{ /form:contact }}
```

### Blade

#### Simple Blade forms (Spatie)

For simple Blade forms (outside of Statamic's form tags), you can use the default Blade component or directive provided by `spatie/laravel-honeypot` (exactly as shown in Spatie's documentation):

```blade
<form method="POST" action="{{ route('contactForm.submit') }}">
    <x-honeypot />
    <input name="myField" type="text">
</form>
```

Alternatively:

```blade
<form method="POST" action="{{ route('contactForm.submit') }}">
    @honeypot
    <input name="myField" type="text">
</form>
```

#### Alpine.js + Statamic forms (Blade templates)

If you are rendering Statamic forms inside Blade templates and you are using Statamic's Alpine-driven form features (via `js="honeypot"` on the form tag), use the Statamic tag component provided by this addon.

Important: in this Statamic + Alpine scenario, use `<s:isapp:honeypot />` (this addon), not Spatie’s Blade component/directive.

```blade
<s:form:contact js="honeypot">
    <s:isapp:honeypot />
    ...
</s:form:contact>
```

---

## How spam is detected

All spam detection is handled by `spatie/laravel-honeypot`.

That includes:
- Detecting filled honeypot fields
- Detecting submissions that are too fast
- Rejecting or flagging suspicious requests

This addon does not implement its own spam logic. It simply ensures that Statamic form submissions pass through Spatie’s honeypot validation.

---

## Compatibility

This addon is designed specifically for Statamic and integrates with its form handling system.

It does not provide honeypot protection for generic Laravel Blade forms or third-party form builders.

---

## Credits & Licensing

This addon uses the open-source package:

**spatie/laravel-honeypot**  
Copyright © Spatie  
Licensed under the MIT License

Spatie’s package remains fully open-source and is distributed under its original license.

This Statamic addon is a **commercial product** that provides a Statamic-specific integration layer on top of Spatie’s open-source package. No part of Spatie’s code is sold, relicensed, or restricted.

---

## Support

Support for this Statamic addon is provided by [ISAPP](https://isapp.be).

For issues related to the underlying honeypot logic, please refer to the Spatie package and its documentation.
