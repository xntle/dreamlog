<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DreamSeed extends Seeder
{
    public function run()
    {
        $dreamTitles = [
            'Floating City in the Sky',
            'Talking Cat on a Bus',
            'Endless Library',
            'Swimming through Stars',
            'Giant Garden of Mirrors',
            'Staircase to a Hidden Lake',
            'Melting Chocolate Mountains',
            'Whispers in the Foggy Forest',
            'Dancing Shadows at Midnight',
            'The Bridge Beyond the Moon'
        ];

        $dreamContents = [
            'I found myself walking in a city made of glass, floating above the clouds. The buildings shimmered like prisms, refracting the light into endless rainbows. People floated gently through the streets, humming melodies that seemed to guide the city itself. I felt weightless and free, as if gravity had forgotten me.',
            'A ginger cat wearing a tie sat next to me on a crowded bus, casually reading a newspaper. It looked at me, tilted its head, and began explaining the mysteries of the universe in a soft British accent. The bus was filled with other animals, all dressed for work, chatting about quantum physics. I listened, captivated by the strange normalcy of it all.',
            'Rows of glowing books stretched endlessly into the horizon, each cover alive with shifting images. As I opened one, I was transported into the life of a stranger, feeling their joys and sorrows as my own. The librarian, a figure made entirely of pages, told me that these stories could be borrowed, but never owned. I wandered through lifetimes, forgetting which was mine.',
            'I swam through the velvet depths of space, stars brushing against my skin like warm embers. Nebulas bloomed like coral reefs, their colors dancing around me in slow motion. Planets drifted by like giant marbles, each whispering forgotten tales. There was no fear, only an endless, cosmic calm.',
            'Mirrors grew like flowers from the earth, reflecting countless versions of myself. Some smiled, others wept, and a few turned their backs on me entirely. As I touched one mirror, it rippled like water, pulling me into a world where reflections ruled. I wandered among mirrored beings, each showing me pieces of who I could have been.',
            'I climbed an ancient staircase spiraling into the clouds, each step carved with forgotten symbols. At the top, a hidden lake glowed under a sky painted in violets and gold. The air shimmered with the scent of dreams, and I could hear songs drifting from the water’s depths. I dipped my hand in, and visions of forgotten places played across my skin.',
            'Mountains made entirely of chocolate stretched before me, slowly melting into rivers of caramel and honey. The air was thick with the scent of sweetness, and candy birds sang from licorice trees. I sailed in a candy-striped boat, watching as the chocolate peaks crumbled into syrupy waves. It was beautiful and deliciously surreal.',
            'A thick fog swallowed the forest, where every tree whispered my name in ancient languages. Though I couldn’t understand the words, they filled me with a strange comfort, as if the forest itself remembered me. Shadows danced in the mist, guiding me along paths that appeared only when I stopped looking. I followed them deeper, feeling both lost and found.',
            'At midnight, the shadows came alive, swirling and dancing around me in joyous celebration. They held my hands, pulling me into their ghostly waltz, their laughter echoing through the empty streets. The moonlight painted silver patterns on the ground, creating a stage for their eerie ballet. I danced until dawn, feeling weightless and free.',
            'A crystal bridge stretched beyond the moon, glittering like diamonds against the darkness. As I walked across, dreams from other worlds drifted toward me, wrapping around my thoughts like gentle breezes. I saw glimpses of alien landscapes, of people I would never meet, of stories yet unwritten. The bridge led me onward, into the unknown.',
        ];

        $dreamTags = [
            'fantasy, sky, flying',
            'funny, surreal, animal',
            'mystery, books, library',
            'space, calm, adventure',
            'mirror, self, surreal',
            'adventure, lake, serenity',
            'food, surreal, candy',
            'mystery, forest, whispers',
            'night, shadows, dance',
            'space, dreams, bridge',
        ];

        $sampleDreams = [];

        foreach ($dreamTitles as $index => $title) {
            $sampleDreams[] = [
                'title' => $title,
                'content' => $dreamContents[$index],
                'tags' => $dreamTags[$index],
                'image_url' => base_url('uploads/seed' . ($index + 1) . '.png'),
                'created_at' => (new \DateTime())->modify('-' . $index + 1 . ' days')->format('Y-m-d H:i:s'),
            ];
        }

        $this->db->table('dreams')->insertBatch($sampleDreams);
    }
}
