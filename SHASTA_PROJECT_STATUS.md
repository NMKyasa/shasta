# SHASTA PROJECT STATUS

## PROJECT OVERVIEW

SHASTA is a custom-built enterprise CMS/security management platform developed in raw PHP.

The system uses:

- Custom PHP framework architecture
- Custom migration engine
- Custom schema builder
- AdminLTE for admin dashboard
- Bootstrap Securex template for frontend UI
- MySQL/MariaDB database
- Apache/XAMPP development environment

---

# CURRENT PROJECT STATUS

## DATABASE ARCHITECTURE

The database architecture foundation is largely completed.

Current architecture includes:

### CORE SYSTEM TABLES

- migrations
- users
- roles
- permissions
- role_permissions
- user_permissions
- audit_logs
- settings
- notifications
- activity_sessions

### CMS INFRASTRUCTURE TABLES

- media
- categories
- categoryables
- menus
- menu_items
- seo_redirects

### BUSINESS MODULE TABLES

- services
- projects
- project_service
- inquiries
- team_members
- testimonials
- pricing_items

### CMS ENGINE TABLES

- pages
- page_sections

---

# DATABASE ARCHITECTURE DECISIONS

## RBAC SYSTEM

The project uses:

- Granular permissions
- Dynamic permission inheritance
- Role-based permissions
- User-level permission overrides

Permission flow:

Role Permissions
+
User Permission Overrides
=
Final User Permissions

---

## MEDIA SYSTEM

The project uses:

- One centralized media table
- Polymorphic relationships

Examples:

- services media
- projects galleries
- testimonials images
- team member photos

Media supports:

- featured images
- ordering
- soft deletes
- active/inactive states

---

## CATEGORY SYSTEM

The project uses:

- One centralized categories table
- Polymorphic category relationships

Supported modules include:

- services
- projects
- future modules

---

## PAGE BUILDER SYSTEM

Pages support:

- reusable sections
- dynamic blocks
- drag/drop ordering
- flexible rendering

Implemented using:

- pages
- page_sections

---

## SEO ARCHITECTURE

SEO support includes:

- slugs
- meta titles
- meta descriptions
- meta keywords
- canonical URLs
- SEO redirects

---

## SOFT DELETE STRATEGY

The project uses soft deletes extensively for:

- recoverability
- admin recycle-bin behavior
- frontend visibility control

---

# CURRENT FRAMEWORK FEATURES

## MIGRATION ENGINE

Implemented features:

- php console migrate
- php console migrate:rollback
- php console make:migration

---

## SCHEMA BUILDER

Current Blueprint methods include:

- id()
- string()
- text()
- longText()
- boolean()
- enum()
- bigInteger()
- decimal()
- timestamps()
- softDeletes()
- index()
- unique()
- nullable()
- default()
- foreign()

---

## DATABASE FEATURES

Supported features include:

- foreign keys
- indexes
- cascading deletes
- soft deletes
- decimal financial fields

---

# FRONTEND ARCHITECTURE

Frontend stack:

- Bootstrap Securex template
- Dynamic CMS rendering
- Clean URLs
- SEO-friendly structure

---

# ADMIN PANEL ARCHITECTURE

Admin stack:

- AdminLTE
- Permission-driven sidebar
- RBAC middleware
- Dynamic menus
- Notification system

---

# SECURITY ARCHITECTURE

Security features planned/implemented:

- audit logs
- activity sessions
- RBAC
- dynamic inheritance
- permission overrides
- notification system
- future login attempt monitoring

---

# CURRENT DEVELOPMENT PHASE

The project is transitioning from:

DATABASE DESIGN PHASE

to:

APPLICATION LAYER DEVELOPMENT PHASE

---

# NEXT MAJOR DEVELOPMENT TASKS

## CORE FRAMEWORK

Still to build:

- Router
- Request class
- Response class
- Base Controller
- Base Model
- Query Builder
- Validation system
- Middleware system

---

## AUTHENTICATION SYSTEM

Still to build:

- Login system
- Session authentication
- RBAC middleware
- Permission checks
- Forgot password
- Password reset

---

## ADMIN PANEL

Still to build:

- AdminLTE integration
- Dynamic sidebar
- Dashboard
- CRUD generators
- Settings UI
- Media manager

---

## FRONTEND CMS

Still to build:

- Dynamic page rendering
- Services pages
- Projects pages
- Dynamic menus
- SEO rendering
- Media galleries

---

# ENVIRONMENT

## DEVELOPMENT ENVIRONMENT

Current environment:

- Windows
- XAMPP
- Apache
- MySQL/MariaDB
- PHP

Project path:

E:\xampp\htdocs\shasta

---

# IMPORTANT NOTES

## DATABASE

The database was rebuilt from scratch using a new architecture.

Old database structures were intentionally ignored to avoid architectural limitations.

---

## FILE STORAGE

Media uploads use centralized storage architecture.

Frontend visibility depends on:

- media status
- soft delete state

---

## CURRENT PRIORITY

The next priority is:

APPLICATION LAYER IMPLEMENTATION

NOT additional database expansion.

---

# IMPORTANT FUTURE CONSIDERATIONS

Potential future enhancements:

- jobs queue
- failed_jobs
- email logs
- login attempts
- API tokens
- content revisions
- dynamic form builder

These are NOT critical for the current MVP phase.

---

# PROJECT GOAL

Build a scalable, enterprise-grade CMS/security platform in raw PHP with:

- modular architecture
- RBAC
- SEO support
- CMS flexibility
- enterprise security
- scalable database design
- AdminLTE backend
- Bootstrap frontend

# FRAMEWORK MATURITY UPDATE

SHASTA has now transitioned from foundational framework engineering
into active enterprise CMS/application development.

The framework now includes:

## CORE FRAMEWORK

- Custom MVC architecture
- Router system
- Dynamic route parameters
- Middleware support
- Authentication system
- Validation engine
- Request/Response abstraction
- Model layer
- Layout rendering engine
- Partial rendering system
- Asset helper system
- URL helper system
- Resource path helper system

## DATABASE ENGINE

- Custom migrations engine
- Rollback support
- Seeder engine
- Schema builder
- Blueprint system
- Soft delete support

## SECURITY

- Session authentication
- Auth middleware
- Password hashing
- Validation layer

## ADMIN PANEL

- AdminLTE integration
- Modular admin layout architecture
- Sidebar partial system
- Navbar partial system
- Footer partial system

## APPLICATION STATUS

SHASTA is no longer in pure framework setup phase.

The project has officially entered:
- module development,
- enterprise CMS architecture,
- AdminLTE-based admin panel development.

# ADMINLTE ARCHITECTURE

The AdminLTE starter template has been successfully converted
into a modular MVC layout system.

## Layout Structure

resources/views/

    layouts/
        admin.php
        auth.php

    partials/

        admin/
            navbar.php
            sidebar.php
            footer.php

    admin/

        dashboard/
            index.php

        services/
            index.php

## Purpose

### layouts/

Contains master wrappers:
- HTML structure
- CSS includes
- JS includes
- shared wrappers

### partials/

Contains reusable UI fragments:
- sidebar
- navbar
- footer

### admin/

Contains actual module pages only.

This architecture ensures:
- reusable admin UI,
- scalable module development,
- cleaner separation of concerns.

# ADMIN SIDEBAR ARCHITECTURE

The AdminLTE demo sidebar has been replaced with
a scalable SHASTA CMS navigation architecture.

## Sidebar Sections

### Main
- Dashboard

### Content Management
- Services
- Projects
- Pages
- Blog Posts

### Media
- Media Library

### Communication
- Inquiries
- Subscribers

### Users & Access
- Users
- Roles
- Permissions

### Website Settings
- Menus
- Settings

### Account
- Logout

## Purpose

The sidebar is now organized around:
- business domains,
- module scalability,
- future RBAC enforcement.

This prepares SHASTA for:
- enterprise growth,
- module expansion,
- dynamic permission-based navigation later.

# SERVICES MODULE ARCHITECTURE

The Services module is the first major enterprise CRUD module
being developed inside SHASTA.

## Current Features

- AdminLTE listing page
- Services model
- Admin controller
- Dashboard integration
- Sidebar integration

## Services Table Structure

The services table currently supports:

- title
- slug
- summary
- body
- meta_title
- meta_description
- meta_keywords
- canonical_url
- featured
- status
- featured_image
- icon
- created_by
- updated_by
- soft deletes

## SEO Architecture

Services are SEO-aware entities supporting:
- clean slugs,
- meta titles,
- meta descriptions,
- canonical URLs.

## Frontend Goals

Future frontend structure:

/services
/services/{slug}

## CMS Goals

Services support:
- featured homepage sections,
- category grouping,
- media support,
- frontend rendering,
- SEO optimization.

# POLYMORPHIC CATEGORY SYSTEM

SHASTA uses a shared polymorphic category architecture.

## Tables

- categories
- categoryables

## Purpose

Categories are shared across multiple modules including:
- services
- projects
- future blog modules
- future product modules

## categoryables Structure

The categoryables table allows:

category_id
categoryable_type
categoryable_id

Example:

| category_id | categoryable_type | categoryable_id |
|--------------|-------------------|-----------------|
| 1            | service           | 4               |
| 2            | project           | 9               |

## Benefits

This architecture provides:
- reusable taxonomies,
- scalable categorization,
- enterprise CMS flexibility,
- module independence.

## IMPORTANT DESIGN DECISION

Services do NOT contain category_id directly.

All category relationships are managed through:
- categoryables.

# GLOBAL HELPER SYSTEM

SHASTA now includes globally available helper functions.

## Current Helpers

### asset()

Generates public asset URLs.

Example:

asset('assets/admin/dist/css/adminlte.min.css')

### url()

Generates application URLs.

Example:

url('dashboard/services')

### resource_path()

Generates paths inside resources directory.

Example:

resource_path('views/admin/services/index.php')

## Purpose

The helper system prevents:
- hardcoded paths,
- asset duplication,
- environment migration issues.

This also prepares SHASTA for:
- future CDN support,
- deployment flexibility,
- multi-environment compatibility.

# CURRENT DEVELOPMENT PHASE

SHASTA has officially transitioned into:

ENTERPRISE CMS MODULE DEVELOPMENT

Current focus areas:

- AdminLTE integration
- Services module
- CRUD architecture
- Shared taxonomy architecture
- Modular admin UI

## Immediate Next Goals

- Active sidebar states
- Services create form
- Services edit form
- Slug generation
- Validation integration
- Category attachment system
- Media uploads

## Future Planned Modules

- Projects
- Pages
- Blog
- Media Manager
- Testimonials
- Team Members
- Careers
- Settings Panel
- Menu Builder
- SEO Manager

