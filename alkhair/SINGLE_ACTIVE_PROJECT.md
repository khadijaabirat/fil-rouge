# 🚫 Restrictions: Création de Projets pour Associations

## 📋 Règles Métier

### Règle 1: Un Seul Projet Actif
**Une association ne peut avoir qu'UN SEUL projet avec le statut `OPEN` à la fois.**

### Règle 2: Rapport d'Impact Obligatoire (RECEIVED)
**Une association ne peut pas créer de nouveau projet si elle a des projets avec des dons au statut `RECEIVED` sans rapport d'impact.**

### Règle 3: Rapport d'Impact Obligatoire (COMPLETED)
**Une association ne peut pas créer de nouveau projet si elle a des projets `COMPLETED` sans rapport d'impact.**

Ces règles garantissent:
- ✅ Meilleure concentration des efforts
- ✅ Gestion optimale des ressources
- ✅ Transparence accrue pour les donateurs
- ✅ Suivi facilité des projets
- ✅ Traçabilité complète des fonds

---

## 🔒 Implémentation

### 1️⃣ Validation dans ProjectController

#### Méthode `create()`
```php
// 1. Vérification fonds reçus (RECEIVED) sans rapport
$hasPendingReports = Project::where('association_id', Auth::id())
    ->whereHas('donations', function ($query) {
        $query->where('status', 'RECEIVED');
    })->exists();
    
if ($hasPendingReports) {
    return redirect()->route('association.dashboard')
        ->with('error', 'Vous devez publier les rapports d\'impact...');
}

// 2. Vérification projets COMPLETED sans rapport
$hasCompletedWithoutReport = Project::where('association_id', Auth::id())
    ->where('status', 'COMPLETED')
    ->whereDoesntHave('impactReport')
    ->exists();
    
if ($hasCompletedWithoutReport) {
    return redirect()->route('association.dashboard')
        ->with('error', 'Vous devez publier le rapport d\'impact...');
}

// 3. Vérification projet OPEN existant
$hasActiveProject = Project::where('association_id', Auth::id())
    ->where('status', 'OPEN')
    ->exists();
    
if ($hasActiveProject) {
    return redirect()->route('association.dashboard')
        ->with('error', 'Vous avez déjà un projet actif...');
}
```

#### Méthode `store()`
```php
// Double vérification avant création
$hasActiveProject = Project::where('association_id', Auth::id())
    ->where('status', 'OPEN')
    ->exists();
    
if ($hasActiveProject) {
    return redirect()->route('association.dashboard')
        ->with('error', 'Vous avez déjà un projet actif...');
}
```

---

### 2️⃣ Modification du Dashboard

#### AssociationController
```php
public function dashboard()
{
    // ...
    
    // Vérifier projet OPEN
    $hasActiveProject = Project::where('association_id', $association->id)
        ->where('status', 'OPEN')
        ->exists();

    return view('association.dashboard', compact(
        'association', 
        'projects', 
        'hasPendingReports', 
        'pendingProject', 
        'hasActiveProject'  // ← Nouvelle variable
    ));
}
```

---

### 3️⃣ Interface Utilisateur

#### Bouton "Nouveau Projet" caché
```blade
@if(!$hasPendingReports && !$hasActiveProject && $association->status === 'ACTIVE')
    <button>Nouveau Projet</button>
@elseif($hasActiveProject)
    <div class="bg-amber-50">
        Projet actif en cours
    </div>
@endif
```

#### Alert d'information
```blade
@elseif($hasActiveProject && $association->status === 'ACTIVE')
    <div class="alert alert-warning">
        <h3>Projet actif en cours</h3>
        <p>Vous devez terminer votre projet actuel avant d'en créer un nouveau.</p>
    </div>
@endif
```

---

## 🎯 Scénarios d'Utilisation

### ✅ Scénario 1: Aucun projet actif, aucun rapport manquant
- **État:** Aucun projet `OPEN`, aucun projet `COMPLETED` sans rapport
- **Action:** Bouton "Nouveau Projet" visible
- **Résultat:** Peut créer un projet

### ❌ Scénario 2: Projet actif existant
- **État:** Un projet avec status `OPEN`
- **Action:** Bouton "Nouveau Projet" caché
- **Résultat:** Redirection avec message d'erreur

### ❌ Scénario 3: Projet COMPLETED sans rapport
- **État:** Projet avec status `COMPLETED` sans `impactReport`
- **Action:** Bouton "Nouveau Projet" caché
- **Résultat:** Redirection avec message d'erreur

### ✅ Scénario 4: Projet complété avec rapport
- **État:** Projet avec status `COMPLETED` avec `impactReport`
- **Action:** Bouton "Nouveau Projet" visible
- **Résultat:** Peut créer un nouveau projet

### ❌ Scénario 5: Fonds reçus (RECEIVED) sans rapport
- **État:** Projet avec dons status `RECEIVED`
- **Action:** Bouton "Nouveau Projet" caché
- **Résultat:** Doit publier rapport d'impact d'abord

---

## 🧪 Tests

### Test 1: Empêcher création multiple
```php
test_association_cannot_create_multiple_active_projects()
```

### Test 2: Autoriser création si aucun projet actif
```php
test_association_can_create_project_when_no_active_project()
```

### Test 3: Autoriser après complétion avec rapport
```php
test_association_can_create_project_after_completing_previous()
```

### Test 4: Empêcher si COMPLETED sans rapport
```php
test_association_cannot_create_project_if_completed_without_report()
```

### Test 5: Affichage warning projet actif
```php
test_dashboard_shows_active_project_warning()
```

### Test 6: Affichage warning rapport manquant
```php
test_dashboard_shows_completed_without_report_warning()
```

**Total: 6 tests**

---

## 📊 Statuts de Projet

| Statut | Peut créer nouveau projet? |
|--------|---------------------------|
| `OPEN` | ❌ NON |
| `CLOSED` | ✅ OUI |
| `COMPLETED` | ✅ OUI |
| `SUSPENDED` | ✅ OUI |

---

## 🔄 Workflow

```
1. Association crée projet A (status: OPEN)
   ↓
2. Bouton "Nouveau Projet" disparaît
   ↓
3. Alert "Projet actif en cours" s'affiche
   ↓
4. Projet A atteint objectif → status: COMPLETED
   ↓
5. Bouton "Nouveau Projet" réapparaît
   ↓
6. Association peut créer projet B
```

---

## 📝 Messages d'Erreur

### 1. Projet actif existant
```
"Action bloquée : Vous avez déjà un projet actif en cours. 
Veuillez le terminer avant d'en créer un nouveau."
```

### 2. Fonds reçus sans rapport (RECEIVED)
```
"Action bloquée : Vous devez d'abord publier les rapports d'impact 
de vos projets précédents (fonds reçus) avant de créer un nouveau projet."
```

### 3. Projet COMPLETED sans rapport
```
"Action bloquée : Vous devez publier le rapport d'impact de votre 
projet complété avant de créer un nouveau projet."
```

---

## 🎨 UI/UX

### Badge d'information
- **Couleur:** Amber (orange clair)
- **Icône:** `info`
- **Position:** En haut du dashboard

### Bouton désactivé
- **Texte:** "Projet actif en cours"
- **Style:** Non cliquable, informatif
- **Couleur:** Amber background

---

## 🔧 Fichiers Modifiés

1. ✅ `app/Http/Controllers/ProjectController.php`
   - Méthode `create()`
   - Méthode `store()`

2. ✅ `app/Http/Controllers/AssociationController.php`
   - Méthode `dashboard()`

3. ✅ `resources/views/association/dashboard.blade.php`
   - Condition bouton "Nouveau Projet"
   - Alert d'information
   - Empty state

4. ✅ `tests/Feature/SingleActiveProjectTest.php`
   - 4 tests de validation

---

## ✅ Avantages

1. **Concentration:** Association focus sur un projet à la fois
2. **Qualité:** Meilleure gestion et suivi
3. **Transparence:** Donateurs voient l'engagement
4. **Performance:** Moins de projets abandonnés
5. **Simplicité:** Interface plus claire

---

**Implémenté le:** <?= date('d/m/Y') ?>  
**Conforme au cahier des charges:** ✅
