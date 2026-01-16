# Admin Panel Enhancement Plan (Revised)

I will enhance the Filament Admin panel to be fully functional and comprehensive, specifically focusing on fixing the Leads module and building a detailed Projects system.

## 1. Leads Module Fixes ("Make it Functional")
The user noted the Leads module "visually looks okay but is not functional." I will address this by ensuring all relationships and actions work:
-   **Status Workflow:** Ensure changing a Lead's status (e.g., to "Converted") triggers necessary actions (like creating a Project/Client).
-   **Notes & Communications:** Verify that the `LeadNote` and `LeadCommunication` relationships are correctly saving and displaying in the Lead View/Edit pages.
-   **Tasks:** Ensure `LeadTask` items can be added, edited, and marked complete directly from the Lead resource.
-   **Assignment:** Fix the "Assigned To" user relationship to ensure leads are correctly routed to team members.

## 2. Detailed Projects Module
I will build a robust `ProjectResource` that goes beyond basic tracking:
-   **Database Structure:**
    -   `projects` table: `title`, `lead_id` (client), `manager_id` (user), `status`, `priority`, `start_date`, `due_date`, `budget`, `spent_amount`.
    -   `project_milestones`: `project_id`, `title`, `due_date`, `status`.
    -   `project_tasks`: `project_id`, `milestone_id`, `assigned_to`, `title`, `description`, `status`.
-   **Filament Resource:**
    -   **Kanban/Board View (Optional but good):** Or a clean Table view with progress bars.
    -   **Detailed View Page:** Tabs for "Overview", "Milestones", "Tasks", "Files", and "Invoices".
    -   **Relations:** Deep integration with Leads (origin) and Invoices (billing).

## 3. Invoices Module
-   **Database:** `invoices` table linking to `projects` and `quotes`.
-   **Features:** Status tracking (Draft, Sent, Paid), PDF generation, and automatic calculation of totals/taxes.

## 4. Execution Steps
1.  **Fix Leads:** Debug and refine `LeadResource`, ensuring Notes, Tasks, and Communications are fully functional sub-resources or relation managers.
2.  **Create Projects:** Generate migrations, models, and a detailed `ProjectResource` with Milestone/Task support.
3.  **Create Invoices:** Implement the invoicing system linked to projects.
4.  **Verification:** Test the flow: Lead $\rightarrow$ Quote $\rightarrow$ Project $\rightarrow$ Invoice.

I will start by fixing the Leads module functionality.
