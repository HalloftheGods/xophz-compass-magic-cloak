# Xophz Magic Cloak

> **Category:** Wizard's Tower · **Version:** 0.0.1

A modular, event-driven contextual messaging and guidance service for COMPASS.

## Description

**Magic Cloak** is the platform's intelligent companion system. It delivers non-intrusive hints, tips, and system updates through premium "glass toasts" — contextual messages that appear based on the user's current location or action within the COMPASS ecosystem.

### Core Capabilities

- **Contextual Messaging** – Messages appear based on route changes, user actions, and plugin events.
- **Custom Post Type** – `compass_cloak_hint` stores message content, triggers, and configuration.
- **Smart Icon Resolution** – Automatically resolves plugin icons from shorthand IDs, TextDomains, or names.
- **Premium Toast UI** – Glassmorphic snackbar (20px blur, semi-transparent) with micro-animations.

### Message Schema

```typescript
interface MagicHint {
  id: string | number;
  trigger: string;      // e.g., 'route:enter:compass-explore'
  content: string;
  icon?: string;        // Plugin shorthand, ID, Name, Path, or FA class
  priority?: number;
  title?: string;
  timeout?: number;     // Default 8s
}
```

### Smart Icon Resolution Priority

1. **Direct Path/URL** – Contains `/` or `.` → rendered as `<img>`
2. **Plugin Shorthand/ID** – Matches TextDomain or Plugin Name → official SVG
3. **FontAwesome Fallback** – Treated as FA icon class
4. **System Default** – Magic Cloak plugin icon

## Requirements

- **Xophz COMPASS** parent plugin (active)
- WordPress 5.8+, PHP 7.4+

## Installation

1. Ensure **Xophz COMPASS** is installed and active.
2. Upload `xophz-compass-magic-cloak` to `/wp-content/plugins/`.
3. Activate through the Plugins menu.
4. Hints are managed via the `compass_cloak_hint` CPT in WordPress admin.

## PHP Class Map

| Class | File | Purpose |
|---|---|---|
| `Xophz_Compass_Magic_Cloak` | `class-xophz-compass-magic-cloak.php` | Core plugin hooks |
| `Xophz_Compass_Magic_Cloak_CPT` | `class-xophz-compass-magic-cloak-cpt.php` | Custom Post Type for hints |

## Frontend Integration

| Component | Location | Purpose |
|---|---|---|
| `useMagicCloak` | `src/mechanics/useMagicCloak.ts` | Composable — checks activation, listens for events, dispatches toasts |
| `x-snackbar` | `src/components/atoms/` | Glassmorphic toast UI primitive |

## Changelog

### 0.0.1

- Initial release with hint CPT, smart icon resolution, and glassmorphic toast system
