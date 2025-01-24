<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IndustriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Retrieve category IDs for the respective categories
        $industryAreaId = DB::table('categories')->where('category_name', 'industry area')->value('id');
        $domainKnowledgeId = DB::table('categories')->where('category_name', 'domain knowledge')->value('id');
        $industryId = DB::table('categories')->where('category_name', 'industry')->value('id');

        // Industries for 'Industry Area'
        $industryAreaIndustries = [
            'Aeronautical',
            'Aerospace Firms',
            'Dairy',
            'Fertilizers / Pesticides',
            'Tyres',
            'Auto Ancillary',
            'Auto Components',
            'Airlines',
            'Rubber',
            'Plastics',
            'Petrochemical',
            'Appliances',
            'Durables',
            'Heavy Machinery',
            'Industrial Products',
            'Freight',
            'Courier',
            'Automation',
            'Gaming',
            'Broadcasting',
            'PR (Public Relations)',
            'Recruitment / Staffing',
            'Financial Services',
            'Broking',
            'Foods / Beverage',
            'Brewery',
            'Sugar',
            'Distillery',
            'Clinical Research',
            'Medical Devices / Equipment',
            'Restaurants',
            'Catering',
            'IT-Software',
            'IT-Hardware',
            'Semiconductors',
            'Law Enforcement',
            'Legal Services',
            'Warehousing',
            'Shipping',
            'Railways',
            'Iron and Steel',
            'Quarrying',
            'Mining',
            'Biotechnology',
            'Oil and Gas',
            'Solar',
            'Switchgears',
            'Power Transmission',
            'Facility Management',
            'Infrastructure',
            'Construction',
            'Garments / Accessories',
            'Wholesale',
            'Networking',
            'ISP',
            'Recycling',
            'Water Treatment',
            'Ford',
            'Strategy',
            'Other'
        ];

        // Industries for 'Domain Knowledge'
        $domainKnowledgeIndustries = [
            'Accounts',
            'Administration',
            'Advertising',
            'Airlines',
            'Analytics & Business Intelligence',
            'Architecture',
            'Audit',
            'BPO',
            'Banking',
            'Beauty',
            'Biotechnology',
            'Broadcasting',
            'Business Development',
            'CSR & Sustainability',
            'Company Secretary',
            'Content',
            'Corporate Planning',
            'Counselling',
            'Creative',
            'Customer Service',
            'Data Entry',
            'Defence Forces',
            'Design',
            'Editing',
            'Education',
            'Engineering Design',
            'Executive Assistant',
            'Export',
            'Fashion Designing',
            'Films',
            'Finance',
            'Financial Services',
            'Fitness',
            'Front Office',
            'Full Time',
            'HR',
            'Healthcare',
            'Hotels',
            'IR',
            'IT Hardware',
            'IT Software',
            'ITES',
            'Import',
            'Insurance',
            'Intellectual Property',
            'Interior Design',
            'Investments',
            'Journalism',
            'KPO',
            'LPO',
            'Legal',
            'Logistics',
            'MR',
            'Maintenance',
            'Management Consulting',
            'Manufacturing',
            'Marketing',
            'Materials',
            'Media Planning',
            'Medical',
            'Merchandising',
            'Operations',
            'PR',
            'Permanent',
            'Pharmaceuticals',
            'Production',
            'Project Management',
            'Purchase',
            'R&D',
            'Recruitment',
            'Regulatory',
            'Restaurants',
            'Retail',
            'Sales',
            'Security Services',
            'Shipping',
            'Site Engineering',
            'Spa Services',
            'Strategy',
            'Supply Chain',
            'TV',
            'Tax',
            'Teaching',
            'Technical Support',
            'Telecom Engineering',
            'Ticketing',
            'Tours',
            'Training',
            'Travel',
            'User Experience'
        ];

        // Insert data into the industries table
        $generalIndustries = [
            'Accounting',
            'Advertising',
            'Aerospace',
            'Agriculture',
            'Airlines',
            'Animation',
            'Architecture',
            'Automobile',
            'Aviation',
            'Banking',
            'Beauty',
            'Biotech',
            'BPO',
            'Broadcasting',
            'Chemicals',
            'Clinical Research',
            'Construction',
            'Consumer Electronics',
            'Defence',
            'E-commerce',
            'Education',
            'Electricals',
            'Electronics',
            'Energy',
            'Engineering',
            'Entertainment',
            'Event Management',
            'Export / Import',
            'Facility Management',
            'Finance',
            'Financial Services',
            'FMCG',
            'Food Processing',
            'Government',
            'Healthcare',
            'Heavy Machinery',
            'Hospitality',
            'Industrial Products',
            'Infrastructure',
            'Insurance',
            'Interior Design',
            'Internet',
            'Iron and Steel',
            'IT',
            'ITeS',
            'KPO',
            'Legal',
            'Management Consulting',
            'Marine',
            'Media',
            'Metals',
            'Mining',
            'NGO',
            'Oil and Gas',
            'Packaging',
            'Pharmaceuticals',
            'Power',
            'Publishing',
            'Real Estate / Property',
            'Retail',
            'Security',
            'Social Services',
            'Software Services',
            'Sports',
            'Telecom',
            'Textiles',
            'Transportation',
            'Travel',
            'Warehousing',
            'Waste Management',
            'Wellness'
        ];

        // Insert 'Industry Area' industries
        $industryAreaData = [];
        foreach ($industryAreaIndustries as $name) {
            $industryAreaData[] = [
                'category_id' => $industryAreaId,
                'industry_name' => $name,
                'industry_description' => '',
            ];
        }
        DB::table('industries')->insert($industryAreaData);

 // Insert 'Domain Knowledge' industries
        $domainKnowledgeData = [];
        foreach ($domainKnowledgeIndustries as $name) {
            $domainKnowledgeData[] = [
                'category_id' => $domainKnowledgeId,
                'industry_name' => $name,
                'industry_description' => '',
            ];
        }
        DB::table('industries')->insert($domainKnowledgeData);

        // Insert general industries
        $generalIndustriesData = [];
        foreach ($generalIndustries as $name) {
            $generalIndustriesData[] = [
                'category_id' => $industryId,
                'industry_name' => $name,
                'industry_description' => '',
            ];
        }
        DB::table('industries')->insert($generalIndustriesData);
    }
}