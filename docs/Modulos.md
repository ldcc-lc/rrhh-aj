Monolito Modular
       │
       ├── Módulos funcionales
       │
       ├── Separación de responsabilidades
       │
       ├── Laravel
       │
       ├── Vue + Inertia
       │
       └── PostgreSQL

# Módulos del Sistema RRHH-AJ

**Proyecto:** RRHH-AJ  
**Versión:** 1.0  
---

## 1. Objetivo

Este documento define la primera división funcional del sistema de Recursos Humanos RRHH-AJ.

La aplicación se implementará inicialmente como un **monolito modular**, utilizando Laravel como backend, Vue como frontend e Inertia como mecanismo de comunicación entre ambos.

La división en módulos busca mantener una separación clara de responsabilidades y facilitar el crecimiento futuro del sistema.

---

## 2. Tipo de Arquitectura

Arquitectura monolitica moderna con patron MVC

---

# 2. Mapa general de módulos

El sistema se divide inicialmente en cinco módulos principales:

```text

RRHH-AJ
│
├── 01. Personas
│
├── 02. Estructura Organizacional
│
├── 03. Gestión Laboral
│
├── 04. Acceso y Seguridad
│
└── 05. Reportes
