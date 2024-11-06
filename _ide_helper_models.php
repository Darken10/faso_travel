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
 * @property string $name
 * @property string $sigle
 * @property string|null $slogant
 * @property string|null $description
 * @property string|null $logo_uri
 * @property int|null $user_id
 * @property int $statut_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Gare> $gares
 * @property-read int|null $gares_count
 * @property-read Statut $statut
 * @property-read User|null $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $users
 * @property-read int|null $users_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Voyage> $voyages
 * @property-read int|null $voyages_count
 * @method static \Illuminate\Database\Eloquent\Builder|Compagnie newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Compagnie newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Compagnie query()
 * @method static \Illuminate\Database\Eloquent\Builder|Compagnie whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compagnie whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compagnie whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compagnie whereLogoUri($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compagnie whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compagnie whereSigle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compagnie whereSlogant($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compagnie whereStatutId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compagnie whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compagnie whereUserId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Voyage\Classe> $classes
 * @property-read int|null $classes_count
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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Voyage> $arrives
 * @property-read int|null $arrives_count
 * @property-read Compagnie|null $compagnie
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Voyage> $departs
 * @property-read int|null $departs_count
 * @property-read Statut $statut
 * @property-read User $user
 * @property-read Ville $ville
 * @method static \Illuminate\Database\Eloquent\Builder|Gare newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Gare newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Gare query()
 * @method static \Illuminate\Database\Eloquent\Builder|Gare whereCompagnieId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gare whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gare whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gare whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gare whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gare whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gare whereStatutId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gare whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gare whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gare whereVilleId($value)
 * @mixin \Eloquent
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
 * @method static \Illuminate\Database\Eloquent\Builder|Membership newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Membership newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Membership query()
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereUserId($value)
 * @mixin \Eloquent
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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Post> $posts
 * @property-read int|null $posts_count
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @mixin \Eloquent
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
 * @property-read Post|null $post
 * @property-read User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereCommentableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereCommentableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereNbLikes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereUserId($value)
 * @mixin \Eloquent
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
 * @property-read Post|null $post
 * @property-read User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Like newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Like newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Like query()
 * @method static \Illuminate\Database\Eloquent\Builder|Like whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Like whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Like wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Like whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Like whereUserId($value)
 * @mixin \Eloquent
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
 * @property array|null $images_uri
 * @property int $nb_views
 * @property int|null $user_id
 * @property int|null $category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Category|null $category
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Comment> $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Like> $likes
 * @property-read int|null $likes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Tag> $tags
 * @property-read int|null $tags_count
 * @property-read User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereImagesUri($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereNbViews($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUserId($value)
 * @mixin \Eloquent
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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Post> $posts
 * @property-read int|null $posts_count
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Tag extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @mixin \Eloquent
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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Compagnie> $compagnies
 * @property-read int|null $compagnies_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Gare> $gares
 * @property-read int|null $gares_count
 * @method static \Illuminate\Database\Eloquent\Builder|Statut newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Statut newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Statut query()
 * @method static \Illuminate\Database\Eloquent\Builder|Statut whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Statut whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Statut whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Statut whereUpdatedAt($value)
 * @mixin \Eloquent
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
 * @property-read \App\Models\Membership $membership
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\TeamFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Team newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Team newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Team query()
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team wherePersonalTeam($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereUserId($value)
 * @mixin \Eloquent
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
 * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation query()
 * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation whereUpdatedAt($value)
 * @mixin \Eloquent
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
 * @property-read User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|AutrePersonne newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AutrePersonne newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AutrePersonne query()
 * @method static \Illuminate\Database\Eloquent\Builder|AutrePersonne whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AutrePersonne whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AutrePersonne whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AutrePersonne whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AutrePersonne whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AutrePersonne whereLienRelation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AutrePersonne whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AutrePersonne whereNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AutrePersonne whereNumeroIdentifiant($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AutrePersonne whereSexe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AutrePersonne whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AutrePersonne whereUserId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Ticket\Ticket> $tickets
 * @property-read int|null $tickets_count
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
 * @property StatutPayement $statut
 * @property MoyenPayment $moyen_payment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Ticket\Ticket|null $ticket
 * @method static \Illuminate\Database\Eloquent\Builder|Payement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payement query()
 * @method static \Illuminate\Database\Eloquent\Builder|Payement whereCodeOtp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payement whereMontant($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payement whereMoyenPayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payement whereNumeroPayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payement whereStatut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payement whereTicketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payement whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payement whereTransId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payement whereUpdatedAt($value)
 * @mixin \Eloquent
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
 * @property TypeTicket $type
 * @property StatutTicket $statut
 * @property string $numero_ticket
 * @property int|null $numero_chaise
 * @property string $code_sms
 * @property string $code_qr
 * @property string|null $image_uri
 * @property string|null $pdf_uri
 * @property string|null $code_qr_uri
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $is_my_ticket
 * @property int|null $autre_personne_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Ticket\Payement> $payements
 * @property-read int|null $payements_count
 * @property-read User|null $user
 * @property-read Voyage|null $voyage
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereABagage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereAutrePersonneId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereBagagesData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCodeQr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCodeQrUri($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCodeSms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereImageUri($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereIsMyTicket($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereNumeroChaise($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereNumeroTicket($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket wherePdfUri($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereStatut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereVoyageId($value)
 * @mixin \Eloquent
 * @property string|null $transferer_at
 * @property int|null $valider_by_id
 * @property string|null $valider_at
 * @property int|null $transferer_a_user_id
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent|null $autre_personne
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereTransfererAUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereTransfererAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereValiderAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereValiderById($value)
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
 * @property mixed $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $two_factor_confirmed_at
 * @property string|null $remember_token
 * @property int|null $current_team_id
 * @property string|null $profile_photo_path
 * @property UserRole $role
 * @property string $statut
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $compagnie_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Authenticatable> $autrePersonnes
 * @property-read int|null $autre_personnes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Comment> $comments
 * @property-read int|null $comments_count
 * @property-read Compagnie|null $compagnie
 * @property-read \App\Models\Team|null $currentTeam
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Like> $likes
 * @property-read int|null $likes_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Team> $ownedTeams
 * @property-read int|null $owned_teams_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Post> $posts
 * @property-read int|null $posts_count
 * @property-read string $profile_photo_url
 * @property-read \App\Models\Membership $membership
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Team> $teams
 * @property-read int|null $teams_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Ticket> $tickets
 * @property-read int|null $tickets_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCompagnieId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCurrentTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNumeroIdentifiant($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfilePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSexe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorConfirmedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Ticket\Ticket> $ticketsAutrePersonne
 * @property-read int|null $tickets_autre_personne_count
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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Region> $regions
 * @property-read int|null $regions_count
 * @method static \Illuminate\Database\Eloquent\Builder|Pays newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pays newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pays query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pays whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pays whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pays whereIdentityNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pays whereIso2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pays whereMoney($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pays whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pays whereUpdatedAt($value)
 * @mixin \Eloquent
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
 * @property-read Pays $pays
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Ville> $villes
 * @property-read int|null $villes_count
 * @method static \Illuminate\Database\Eloquent\Builder|Region newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Region newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Region query()
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region wherePaysId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereUpdatedAt($value)
 * @mixin \Eloquent
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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Trajet> $arrivers
 * @property-read int|null $arrivers_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Trajet> $departs
 * @property-read int|null $departs_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Gare> $gares
 * @property-read int|null $gares_count
 * @property-read Region|null $region
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Voyage> $voyage_arriver
 * @property-read int|null $voyage_arriver_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Voyage> $voyage_depart
 * @property-read int|null $voyage_depart_count
 * @method static \Illuminate\Database\Eloquent\Builder|Ville newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ville newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ville query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ville whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ville whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ville whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ville whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ville whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ville whereRegionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ville whereUpdatedAt($value)
 * @mixin \Eloquent
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
 * @method static \Illuminate\Database\Eloquent\Builder|Classe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Classe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Classe query()
 * @method static \Illuminate\Database\Eloquent\Builder|Classe whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classe whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classe whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classe whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classe whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classe whereUserId($value)
 * @mixin \Eloquent
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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Voyage\Classe> $classes
 * @property-read int|null $classes_count
 * @method static \Database\Factories\Voyage\ConfortFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Confort newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Confort newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Confort query()
 * @method static \Illuminate\Database\Eloquent\Builder|Confort whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Confort whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Confort whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Confort whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Confort whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|Confort whereUserId($value)
 */
	class Confort extends \Eloquent {}
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
 * @property-read Ville $arriver
 * @property-read Ville $depart
 * @property-read User $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Voyage> $voyages
 * @property-read int|null $voyages_count
 * @method static \Illuminate\Database\Eloquent\Builder|Trajet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Trajet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Trajet query()
 * @method static \Illuminate\Database\Eloquent\Builder|Trajet whereArriverId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trajet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trajet whereDepartId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trajet whereDistance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trajet whereEtat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trajet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trajet whereTemps($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trajet whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trajet whereUserId($value)
 * @mixin \Eloquent
 */
	class Trajet extends \Eloquent {}
}

namespace App\Models\Voyage{
/**
 * 
 *
 * @property int $id
 * @property int $trajet_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon $heure
 * @property int $compagnie_id
 * @property int $prix
 * @property int $classe_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $depart_id
 * @property int|null $arrive_id
 * @property int $statut_id
 * @property int $nb_pace
 * @property-read Gare|null $arrive
 * @property-read Compagnie $compagnie
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Confort> $conforts
 * @property-read int|null $conforts_count
 * @property-read Gare|null $depart
 * @property-read Gare|null $gareArriver
 * @property-read Gare|null $gareDepart
 * @property-read Statut|null $statut
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Ticket> $tickets
 * @property-read int|null $tickets_count
 * @property-read Trajet $trajet
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Voyage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Voyage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Voyage query()
 * @method static \Illuminate\Database\Eloquent\Builder|Voyage whereArriveId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voyage whereClasseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voyage whereCompagnieId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voyage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voyage whereDepartId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voyage whereHeure($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voyage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voyage whereNbPace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voyage wherePrix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voyage whereStatutId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voyage whereTrajetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voyage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voyage whereUserId($value)
 * @mixin \Eloquent
 */
	class Voyage extends \Eloquent {}
}

