# 📝 Sélection de Projet pour Rapport d'Impact

## 🎯 Problème Résolu

**Avant:** Le lien `/association/projects/0/impact` causait une erreur 404 car l'ID 0 n'existe pas.

**Après:** Le système affiche une page de sélection listant tous les projets nécessitant un rapport d'impact.

---

## ✨ Fonctionnalité

### Route Modifiée
```php
// Avant
Route::get('/association/projects/{id}/impact', ...)

// Après
Route::get('/association/projects/{id?}/impact', ...)
// id est maintenant optionnel
```

### Comportement

#### Cas 1: Sans ID (ou ID = 0)
```
URL: /association/projects/impact
URL: /association/projects/0/impact

→ Affiche la page de sélection avec liste des projets
```

#### Cas 2: Avec ID spécifique
```
URL: /association/projects/123/impact

→ Affiche le formulaire de création pour le projet #123
```

---

## 📋 Projets Affichés

La page de sélection affiche les projets qui ont besoin d'un rapport d'impact:

### Type 1: Projets COMPLETED sans rapport
```php
Project::where('status', 'COMPLETED')
       ->whereDoesntHave('impactReport')
```

### Type 2: Projets avec dons RECEIVED
```php
Project::whereHas('donations', function($q) {
    $q->where('status', 'RECEIVED');
})
```

---

## 🎨 Interface Utilisateur

### Page de Sélection (`select_project.blade.php`)

#### Header
- Titre: "Publier un Rapport d'Impact"
- Sous-titre: "Sélectionnez le projet..."
- Bouton retour vers dashboard

#### Cards Projet
Chaque projet affiché contient:
- ✅ Image du projet
- ✅ Badge status (Fonds reçus / Complété)
- ✅ Titre et description
- ✅ Barre de progression
- ✅ Montant collecté / Objectif
- ✅ Nombre de dons
- ✅ Bouton "Publier le rapport"

#### Empty State
Si aucun projet ne nécessite de rapport:
- ✅ Icône check_circle verte
- ✅ Message: "Aucun rapport en attente"
- ✅ Félicitations
- ✅ Bouton retour dashboard

---

## 🔄 Workflow

```
1. Association clique "Publier un impact"
   ↓
2. Système vérifie si ID fourni
   ↓
3a. ID fourni → Formulaire direct
   OU
3b. Pas d'ID → Page de sélection
   ↓
4. Association sélectionne un projet
   ↓
5. Redirection vers formulaire avec ID
   ↓
6. Publication du rapport
```

---

## 💻 Code Implémenté

### Controller
```php
public function create($id = null)
{
    // Si id = 0 ou null
    if ($id === null || $id == 0) {
        // Récupérer projets nécessitant rapport
        $projectsNeedingReport = Project::where(...)
            ->orWhere(...)
            ->get();
        
        return view('impact.select_project', compact('projectsNeedingReport'));
    }
    
    // Sinon, formulaire normal
    $project = Project::findOrFail($id);
    return view('impact.impact_create', compact('project'));
}
```

### Route
```php
Route::get('/association/projects/{id?}/impact', [ImpactReportController::class, 'create'])
    ->name('impact.create');
```

### Liens Mis à Jour
```blade
<!-- Sidebar -->
<a href="{{ route('impact.create') }}">Preuves d'impact</a>

<!-- Header Dashboard -->
<a href="{{ route('impact.create') }}">Publier un impact</a>

<!-- Alert -->
<a href="{{ route('impact.create') }}">Publier le rapport maintenant</a>
```

---

## 🧪 Tests

### Test 1: Accès page sélection
```php
test_association_can_access_project_selection_page()
```

### Test 2: Affichage projets COMPLETED
```php
test_project_selection_shows_completed_projects_without_report()
```

### Test 3: Affichage projets RECEIVED
```php
test_project_selection_shows_projects_with_received_donations()
```

### Test 4: Empty state
```php
test_project_selection_shows_empty_state_when_no_projects_need_report()
```

### Test 5: Formulaire spécifique
```php
test_can_access_specific_project_impact_form()
```

**Total: 5 tests**

---

## 📊 Avantages

### 1. UX Améliorée
- ✅ Plus d'erreur 404
- ✅ Vue claire des projets nécessitant rapport
- ✅ Navigation intuitive

### 2. Transparence
- ✅ Association voit immédiatement ses obligations
- ✅ Badges visuels (Fonds reçus / Complété)

### 3. Efficacité
- ✅ Sélection rapide du projet
- ✅ Informations complètes sur chaque projet
- ✅ Accès direct au formulaire

---

## 🎯 Cas d'Usage

### Scénario 1: Association avec plusieurs projets
```
1. Clique "Publier un impact"
2. Voit liste de 3 projets nécessitant rapport
3. Sélectionne le projet souhaité
4. Remplit le formulaire
```

### Scénario 2: Association sans projet en attente
```
1. Clique "Publier un impact"
2. Voit message "Aucun rapport en attente"
3. Félicitations affichées
4. Retour au dashboard
```

### Scénario 3: Accès direct depuis dashboard
```
1. Clique "Publier rapport" sur un projet spécifique
2. Accès direct au formulaire (avec ID)
3. Pas de page de sélection
```

---

## 📁 Fichiers Modifiés/Créés

### Modifiés
1. ✅ `ImpactReportController.php` - Méthode `create()`
2. ✅ `routes/web.php` - Route avec `{id?}`
3. ✅ `dashboard.blade.php` - 3 liens mis à jour

### Créés
1. ✅ `select_project.blade.php` - Nouvelle vue
2. ✅ `ImpactReportSelectionTest.php` - 5 tests

---

## 🔧 Maintenance

### Pour ajouter un filtre:
```php
// Dans ImpactReportController::create()
$projectsNeedingReport = Project::where(...)
    ->where('nouvelle_condition', ...)
    ->get();
```

### Pour modifier l'affichage:
```blade
<!-- Dans select_project.blade.php -->
<!-- Modifier les cards projet -->
```

---

## ✅ Checklist

- [x] Route avec paramètre optionnel
- [x] Controller gère les 2 cas
- [x] Vue de sélection créée
- [x] Liens dashboard mis à jour
- [x] Tests automatisés
- [x] Documentation complète
- [x] Empty state géré
- [x] Badges visuels

---

**Statut:** ✅ COMPLET  
**Bug résolu:** ✅ Erreur 404 corrigée  
**Tests:** ✅ 5/5 passés  
**Date:** <?= date('d/m/Y') ?>
