<?php

namespace App\Controllers;

use App\Models\DreamModel;
use CodeIgniter\API\ResponseTrait;


class DreamController extends BaseController
{
    use ResponseTrait;

    /**
     * Display the homepage.
     */
    public function homepage()
    {
        return view('home');
    }

    /**
     * Display the create dream page.
     */
    public function createpage()
    {
        return view('create');
    }

    /**
     * Display the calendar page.
     */
    public function calendarpage()
    {
        return view('calendar');
    }

    /**
     * Handle dream creation form submission.
     * Accepts title, content, tags, and optional image.
     * Stores the dream and redirects to homepage.
     */
    public function create()
    {
        helper(['form', 'url']);

        $model = new DreamModel();

        $title = $this->request->getPost('title');
        $content = $this->request->getPost('content');
        $tags = $this->request->getPost('tags');
        $imageFile = $this->request->getFile('image');

        $imageUrl = null;
        if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
            $newName = $imageFile->getRandomName();
            $imageFile->move(FCPATH . 'uploads', $newName);
            $imageUrl = base_url('uploads/' . $newName);

            log_message('debug', 'Image uploaded to: ' . FCPATH . 'uploads/' . $newName);
            log_message('debug', 'Image URL: ' . $imageUrl);

            echo "<script>console.log('Image uploaded to: " . FCPATH . "uploads/" . $newName . "');</script>";
            echo "<script>console.log('Image URL: " . $imageUrl . "');</script>";
        }

        $model->insert([
            'title' => $title,
            'content' => $content,
            'tags' => $tags,
            'image_url' => $imageUrl
        ]);

        return redirect()->to('/');
    }

    /**
     * Display dreams on the calendar for a given month and year.
     * If year or month not provided, defaults to current.
     */
    public function index($year = null, $month = null)
    {
        $year = $year ?? date('Y');
        $month = $month ?? date('m');

        $dreamModel = new DreamModel();
        $dreams = $dreamModel
            ->where('YEAR(created_at)', $year)
            ->where('MONTH(created_at)', $month)
            ->orderBy('created_at', 'ASC')
            ->findAll();

        $dreamsByDate = [];

        foreach ($dreams as $dream) {
            $date = date('Y-m-d', strtotime($dream['created_at']));
            $dreamsByDate[$date] = [
                'title' => $dream['title'],
                'image' => $dream['image_url'] ?? null,
                'tags' => $dream['tags'] ?? null,
            ];
        }

        return view('calendar', [
            'month' => $month,
            'year' => $year,
            'dreamsByDate' => $dreamsByDate,
        ]);
    }

    /**
     * Return all dreams as JSON.
     *
     * @return \CodeIgniter\HTTP\Response
     */
    public function getDream()
    {
        $dreamModel = new DreamModel();
        $dreams = $dreamModel->orderBy('created_at', 'DESC')->findAll();
        return $this->respond($dreams);
    }

    /**
     * Display a dream by its ID.
     * If dream not found, shows 404 page
     */
    public function view($id)
    {
        $dreamModel = new DreamModel();
        $dream = $dreamModel->find($id);

        if (!$dream) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('dream/view', ['dream' => $dream]);
    }

    /**
     * Alternative method to display a dream by ID.
     * Throws 404 with custom message if not found.
     *
     * @param int $id
     * @return \CodeIgniter\HTTP\Response|string
     * @throws \CodeIgniter\Exceptions\PageNotFoundException
     */
    public function show($id)
    {
        $model = new DreamModel();
        $dream = $model->find($id);

        if (!$dream) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Dream not found");
        }

        return view('dream/view', ['dream' => $dream]);
    }
}
