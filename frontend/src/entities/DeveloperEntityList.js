export default function DeveloperEntityList(developers = []) {

    this.developers = developers;

    this.addDeveloper = (developer) => {
        this.developers.push(developer);
        return this;
    }

    this.setDevelopers = (developers) => {
        this.developers = developers;
        return this;
    }

    this.getDevelopers = () => {
        return this.developers;
    }
}
