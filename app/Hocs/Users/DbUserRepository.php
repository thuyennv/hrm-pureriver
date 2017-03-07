<?php

namespace Nht\Hocs\Users;

use Nht\Hocs\Core\BaseRepository;
use Nht\Hocs\Users\User;

/**
 * Class DbUserRepository.
 *
 * @author  AlvinTran
 */
class DbUserRepository extends BaseRepository implements UserRepository
{
    /**
     * User model
     * @var Eloquent
     */
    protected $model;

    /**
     * Constructor
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Get user by email
     * @param  string $email
     * @return User model
     */
    public function getByEmail($email)
    {
        return $this->model->where('email', $email)->first();
    }

    public function getTypes()
    {
        return $this->model->getTypes();
    }

    /**
     * Get list of User
     * @param  boolean|number $paginate Phân trang
     * @return Collection of User
     */
    public function getActivedUser($paginate = false)
    {
        return $paginate
                ? $this->model->where('active', 1)->paginate($paginate)
                : $this->model->where('active', 1)->all();
    }

    /**
     * Tìm hoặc tạo mới tài khoản user dựa vào ID của họ trên social network
     * @param  obj $user
     * @param  string $provider
     * @return Eloquent model
     */
    public function loginWithSocialite($user, $provider)
    {
        // Login with socialite_id first
        if ($authUser = $this->getBySocialiteId($user, $provider))
        {
            return $authUser;
        }

        // If not exist socialite_id then email
        if ($signedUser = $this->getByEmail($user->getEmail()))
        {
            $signedUser->fill([
                $provider.'_id' => $user->getId()
            ])->save();
            return $signedUser;
        }

        // If not exist at all then create new user
        return $this->create([
            'email' => $user->getEmail(),
            'name' => $user->getName(),
            'nickname' => is_null($user->getNickName()) ? $user->getName() : $user->getNickName(),
            'avatar' => $user->getAvatar(),
            'password' => bcrypt(str_random(10)),
            $provider.'_id' => $user->getId()
        ]);
    }

    /**
     * Hàm tìm kiếm User dựa trên socialite_id
     * @param  obj $user
     * @param  string $provider
     * @return Eloquent model
     */
    public function getBySocialiteId($user, $provider)
    {
        return $this->model->where($provider.'_id', $user->id)->first();
    }

    /**
     * Override creating function
     * @param  array $attributes
     * @return User model
     */
    public function create($attributes)
    {
        // Upload avatar
        if (isset($attributes['avatar'])) {
            $attributes['avatar'] = $this->uploadAvatar();
        }

        if (isset($attributes['password'])) {
            $attributes['password'] = bcrypt($attributes['password']);
        }
        $user = $this->model->create($attributes);

        // Attach roles
        if (isset($attributes['roles'])) {
            $roles = (array) $attributes['roles'];
            $user->roles()->attach($roles);
        }

        return $user;
    }

    /**
     * Override updating function
     * @param  int $id
     * @param  array $condition
     * @return Bool
     */
    public function update($id, $attributes)
    {
        $user = $this->getById($id);

        // Re-upload avatar
        if (isset($attributes['avatar'])) {
            $attributes['avatar'] = $this->uploadAvatar($user->avatar);
        }

        $user->fill($attributes)->save();

        // Sync roles: trừ trường hợp update profile
        if ($id !== \Auth::user()->id) {
            $roles = isset($attributes['roles']) ? $attributes['roles'] : [];
            $user->roles()->sync($roles);
        }

        return $user;
    }

    /**
     * Delete an exist user
     * @return Bool
     */
    public function delete($id)
    {
        $user = $this->getById($id);

        // Delete roles
        $user->roles()->sync([]);

        // Delete avatar
        $this->removeAvatar($user->avatar);
        return $user->delete();
    }

    /**
     * Upload avatar
     * @return string Upload file name
     */
    private function uploadAvatar($oldAvatar = '')
    {
        $fileName = '';
        $configImage = \Config::get('image');
        $arrayCrop = $configImage['array_crop_image'];

        // Process uploading
        $resultUpload = \App::make('ImageFactory')->upload('avatar', PATH_UPLOAD_USER_AVATAR, $arrayCrop, 'crop');
        if ($resultUpload['status'] > 0) {
            // Unlink avatar cũ nếu có
            $this->removeAvatar($oldAvatar, array_keys($arrayCrop));
            $fileName = $resultUpload['filename'];
        }
        return $fileName;
    }

    /**
     * Remove avatar
     * @param  string $avatar File name
     * @return void
     */
    private function removeAvatar($avatar, $resizeArr = [])
    {
        @unlink(PATH_UPLOAD_USER_AVATAR . $avatar); // Original
        foreach ($resizeArr as $size) {
            @unlink(PATH_UPLOAD_USER_AVATAR . $size . $avatar); // Resizes
        }
    }
}
