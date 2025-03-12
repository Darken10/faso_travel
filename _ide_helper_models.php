<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models\Compagnie{
/**
 * 
 *
 * @property int $id
 * @property string $immatrculation
 * @property int $number_place
 * @property \App\Enums\StatutCare $statut
 * @property int $etat
 * @property string|null $image_uri
 * @property int|null $compagnie_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Compagnie\Compagnie|null $compagnie
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Voyage\Voyage> $voyages
 * @property-read int|null $voyages_count
 * @method static \Database\Factories\Compagnie\CareFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Care newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Care newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Care query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Care whereCompagnieId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Care whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Care whereEtat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Care whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Care whereImageUri($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Care whereImmatrculation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Care whereNumberPlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Care whereStatut($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Care whereUpdatedAt($value)
 */
	class Care extends \Eloquent {}
}

namespace App\Models\Compagnie{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $sigle
 * @property string|null $slogant
 * @property string|null $description
 * @property string|null $logo_uri
 * @property int|null $user_id
 * @property int $statut_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Voyage\Classe> $classes
 * @property-read int|null $classes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Compagnie\Gare> $gares
 * @property-read int|null $gares_count
 * @property-read \App\Models\Statut $statut
 * @property-read \App\Models\User|null $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Voyage\Voyage> $voyages
 * @property-read int|null $voyages_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Compagnie newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Compagnie newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Compagnie query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Compagnie whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Compagnie whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Compagnie whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Compagnie whereLogoUri($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Compagnie whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Compagnie whereSigle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Compagnie whereSlogant($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Compagnie whereStatutId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Compagnie whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Compagnie whereUserId($value)
 */
	class Compagnie extends \Eloquent {}
}

namespace App\Models\Compagnie{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property float $lng
 * @property float $lat
 * @property int $ville_id
 * @property int $statut_id
 * @property int $user_id
 * @property int|null $compagnie_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Voyage\Voyage> $arrives
 * @property-read int|null $arrives_count
 * @property-read \App\Models\Compagnie\Compagnie|null $compagnie
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Voyage\Voyage> $departs
 * @property-read int|null $departs_count
 * @property-read \App\Models\Statut $statut
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Ville\Ville $ville
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gare newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gare newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gare query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gare whereCompagnieId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gare whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gare whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gare whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gare whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gare whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gare whereStatutId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gare whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gare whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gare whereVilleId($value)
 */
	class Gare extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $team_id
 * @property int $user_id
 * @property string|null $role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Membership newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Membership newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Membership query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Membership whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Membership whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Membership whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Membership whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Membership whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Membership whereUserId($value)
 */
	class Membership extends \Eloquent {}
}

namespace App\Models\Post{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Post\Post> $posts
 * @property-read int|null $posts_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereUpdatedAt($value)
 */
	class Category extends \Eloquent {}
}

namespace App\Models\Post{
/**
 * 
 *
 * @property int $id
 * @property string $message
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $commentable_type
 * @property int $commentable_id
 * @property int $nb_likes
 * @property-read \App\Models\Post\Post|null $post
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comment query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comment whereCommentableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comment whereCommentableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comment whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comment whereNbLikes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comment whereUserId($value)
 */
	class Comment extends \Eloquent {}
}

namespace App\Models\Post{
/**
 * 
 *
 * @property int $id
 * @property int|null $post_id
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Post\Post|null $post
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Like newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Like newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Like query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Like whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Like whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Like wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Like whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Like whereUserId($value)
 */
	class Like extends \Eloquent {}
}

namespace App\Models\Post{
/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property array<array-key, mixed>|null $images_uri
 * @property int $nb_views
 * @property int|null $user_id
 * @property int|null $category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Post\Category|null $category
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Post\Comment> $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Post\Like> $likes
 * @property-read int|null $likes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Post\Tag> $tags
 * @property-read int|null $tags_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereImagesUri($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereNbViews($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereUserId($value)
 */
	class Post extends \Eloquent {}
}

namespace App\Models\Post{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Post\Post> $posts
 * @property-read int|null $posts_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tag query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tag whereUpdatedAt($value)
 */
	class Tag extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role query()
 */
	class Role extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Compagnie\Compagnie> $compagnies
 * @property-read int|null $compagnies_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Compagnie\Gare> $gares
 * @property-read int|null $gares_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Statut newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Statut newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Statut query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Statut whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Statut whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Statut whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Statut whereUpdatedAt($value)
 */
	class Statut extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property bool $personal_team
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $owner
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TeamInvitation> $teamInvitations
 * @property-read int|null $team_invitations_count
 * @property-read \App\Models\Membership|null $membership
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\TeamFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Team newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Team newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Team query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Team whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Team whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Team whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Team wherePersonalTeam($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Team whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Team whereUserId($value)
 */
	class Team extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $team_id
 * @property string $email
 * @property string|null $role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Team $team
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TeamInvitation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TeamInvitation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TeamInvitation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TeamInvitation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TeamInvitation whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TeamInvitation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TeamInvitation whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TeamInvitation whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TeamInvitation whereUpdatedAt($value)
 */
	class TeamInvitation extends \Eloquent {}
}

namespace App\Models\Ticket{
/**
 * 
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $name
 * @property string $sexe
 * @property string|null $email
 * @property int|null $numero
 * @property string $numero_identifiant
 * @property string|null $lien_relation
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Ticket\Ticket> $tickets
 * @property-read int|null $tickets_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AutrePersonne newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AutrePersonne newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AutrePersonne query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AutrePersonne whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AutrePersonne whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AutrePersonne whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AutrePersonne whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AutrePersonne whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AutrePersonne whereLienRelation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AutrePersonne whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AutrePersonne whereNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AutrePersonne whereNumeroIdentifiant($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AutrePersonne whereSexe($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AutrePersonne whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AutrePersonne whereUserId($value)
 */
	class AutrePersonne extends \Eloquent {}
}

namespace App\Models\Ticket{
/**
 * 
 *
 * @property int $id
 * @property int|null $ticket_id
 * @property int|null $numero_payment
 * @property int $montant
 * @property string|null $trans_id
 * @property string|null $token
 * @property int|null $code_otp
 * @property \App\Enums\StatutPayement $statut
 * @property \App\Enums\MoyenPayment $moyen_payment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Ticket\Ticket|null $ticket
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payement query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payement whereCodeOtp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payement whereMontant($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payement whereMoyenPayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payement whereNumeroPayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payement whereStatut($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payement whereTicketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payement whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payement whereTransId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payement whereUpdatedAt($value)
 */
	class Payement extends \Eloquent {}
}

namespace App\Models\Ticket{
/**
 * 
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $voyage_id
 * @property bool|null $a_bagage
 * @property string|null $bagages_data
 * @property \Illuminate\Support\Carbon $date
 * @property \App\Enums\TypeTicket $type
 * @property \App\Enums\StatutTicket $statut
 * @property string $numero_ticket
 * @property int|null $numero_chaise
 * @property string $code_sms
 * @property string $code_qr
 * @property string|null $image_uri
 * @property string|null $pdf_uri
 * @property string|null $code_qr_uri
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $autre_personne_id
 * @property int $is_my_ticket
 * @property string|null $transferer_at
 * @property int|null $valider_by_id
 * @property string|null $valider_at
 * @property int|null $transferer_a_user_id
 * @property int|null $retour_validate_by
 * @property string|null $retour_validate_at
 * @property-read \App\Models\Ticket\AutrePersonne|null $autre_personne
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Ticket\Payement> $payements
 * @property-read int|null $payements_count
 * @property-read \App\Models\User|null $user
 * @property-read \App\Models\Voyage\Voyage|null $voyage
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereABagage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereAutrePersonneId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereBagagesData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereCodeQr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereCodeQrUri($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereCodeSms($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereImageUri($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereIsMyTicket($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereNumeroChaise($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereNumeroTicket($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket wherePdfUri($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereRetourValidateAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereRetourValidateBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereStatut($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereTransfererAUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereTransfererAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereValiderAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereValiderById($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereVoyageId($value)
 */
	class Ticket extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $name
 * @property string $sexe
 * @property string $email
 * @property int|null $numero
 * @property string $numero_identifiant
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $two_factor_confirmed_at
 * @property string|null $remember_token
 * @property int|null $current_team_id
 * @property string|null $profile_photo_path
 * @property \App\Enums\UserRole $role
 * @property \App\Enums\StatutUser $statut
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $compagnie_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Illuminate\Foundation\Auth\User> $autrePersonnes
 * @property-read int|null $autre_personnes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Post\Comment> $comments
 * @property-read int|null $comments_count
 * @property-read \App\Models\Compagnie\Compagnie|null $compagnie
 * @property-read \App\Models\Team|null $currentTeam
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Post\Like> $likes
 * @property-read int|null $likes_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Team> $ownedTeams
 * @property-read int|null $owned_teams_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Post\Post> $posts
 * @property-read int|null $posts_count
 * @property-read string $profile_photo_url
 * @property-read \App\Models\Membership|null $membership
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Team> $teams
 * @property-read int|null $teams_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Ticket\Ticket> $tickets
 * @property-read int|null $tickets_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Ticket\Ticket> $ticketsAutrePersonne
 * @property-read int|null $tickets_autre_personne_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCompagnieId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCurrentTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereNumeroIdentifiant($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereProfilePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereSexe($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereStatut($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereTwoFactorConfirmedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent implements \Illuminate\Contracts\Auth\MustVerifyEmail {}
}

namespace App\Models\Ville{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $money
 * @property int $identity_number
 * @property string $iso2
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Ville\Region> $regions
 * @property-read int|null $regions_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pays newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pays newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pays query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pays whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pays whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pays whereIdentityNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pays whereIso2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pays whereMoney($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pays whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pays whereUpdatedAt($value)
 */
	class Pays extends \Eloquent {}
}

namespace App\Models\Ville{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property int $pays_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Ville\Pays $pays
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Ville\Ville> $villes
 * @property-read int|null $villes_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region wherePaysId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region whereUpdatedAt($value)
 */
	class Region extends \Eloquent {}
}

namespace App\Models\Ville{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property float $lat
 * @property float $lng
 * @property int|null $region_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Voyage\Trajet> $arrivers
 * @property-read int|null $arrivers_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Voyage\Trajet> $departs
 * @property-read int|null $departs_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Compagnie\Gare> $gares
 * @property-read int|null $gares_count
 * @property-read \App\Models\Ville\Region|null $region
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Voyage\Voyage> $voyage_arriver
 * @property-read int|null $voyage_arriver_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Voyage\Voyage> $voyage_depart
 * @property-read int|null $voyage_depart_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ville newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ville newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ville query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ville whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ville whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ville whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ville whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ville whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ville whereRegionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ville whereUpdatedAt($value)
 */
	class Ville extends \Eloquent {}
}

namespace App\Models\Voyage{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Voyage\Confort> $conforts
 * @property-read int|null $conforts_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Voyage\Voyage> $voyages
 * @property-read int|null $voyages_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Classe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Classe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Classe query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Classe whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Classe whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Classe whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Classe whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Classe whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Classe whereUserId($value)
 */
	class Classe extends \Eloquent {}
}

namespace App\Models\Voyage{
/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Voyage\Classe> $classes
 * @property-read int|null $classes_count
 * @method static \Database\Factories\Voyage\ConfortFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Confort newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Confort newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Confort query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Confort whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Confort whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Confort whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Confort whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Confort whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Confort whereUserId($value)
 */
	class Confort extends \Eloquent {}
}

namespace App\Models\Voyage{
/**
 * 
 *
 * @property \App\Enums\JoursSemain $name
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Voyage\Voyage> $voyages
 * @property-read int|null $voyages_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Days newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Days newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Days query()
 */
	class Days extends \Eloquent {}
}

namespace App\Models\Voyage{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $depart_id
 * @property int $arriver_id
 * @property int|null $distance
 * @property string|null $temps
 * @property int|null $etat
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Ville\Ville $arriver
 * @property-read \App\Models\Ville\Ville $depart
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Voyage\Voyage> $voyages
 * @property-read int|null $voyages_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Trajet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Trajet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Trajet query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Trajet whereArriverId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Trajet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Trajet whereDepartId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Trajet whereDistance($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Trajet whereEtat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Trajet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Trajet whereTemps($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Trajet whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Trajet whereUserId($value)
 */
	class Trajet extends \Eloquent {}
}

namespace App\Models\Voyage{
/**
 * 
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $heure
 * @property int $prix
 * @property int $prix_aller_retour
 * @property int $is_quotidient
 * @property \Illuminate\Support\Carbon|null $temps
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Voyage\Days> $days
 * @property int $trajet_id
 * @property int $user_id
 * @property int $compagnie_id
 * @property int $classe_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $depart_id
 * @property int|null $arrive_id
 * @property int $statut_id
 * @property int $nb_pace
 * @property-read \App\Models\Compagnie\Care|null $care
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Compagnie\Care> $cares
 * @property-read int|null $cares_count
 * @property-read \App\Models\Voyage\Classe $classe
 * @property-read \App\Models\Compagnie\Compagnie $compagnie
 * @property-read int|null $days_count
 * @property-read \App\Models\Compagnie\Gare|null $gareArrive
 * @property-read \App\Models\Compagnie\Gare|null $gareArriver
 * @property-read \App\Models\Compagnie\Gare|null $gareDepart
 * @property-read \App\Models\Statut|null $statut
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Ticket\Ticket> $tickets
 * @property-read int|null $tickets_count
 * @property-read \App\Models\Voyage\Trajet $trajet
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voyage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voyage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voyage query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voyage whereArriveId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voyage whereClasseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voyage whereCompagnieId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voyage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voyage whereDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voyage whereDepartId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voyage whereHeure($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voyage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voyage whereIsQuotidient($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voyage whereNbPace($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voyage wherePrix($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voyage wherePrixAllerRetour($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voyage whereStatutId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voyage whereTemps($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voyage whereTrajetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voyage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voyage whereUserId($value)
 */
	class Voyage extends \Eloquent {}
}

namespace App\Models\Voyage{
/**
 * 
 *
 * @property-read \App\Models\Voyage\Voyage|null $voyage
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VoyageInstance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VoyageInstance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VoyageInstance onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VoyageInstance query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VoyageInstance withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VoyageInstance withoutTrashed()
 */
	class VoyageInstance extends \Eloquent {}
}

